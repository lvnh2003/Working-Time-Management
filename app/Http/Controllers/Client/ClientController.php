<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Project_creator;
use App\Models\Save_time;
use App\Models\User;
use App\Notifications\ChangeStateProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $client = User::find(Auth::user()->idUser);
        return view('client.index', ['client' => $client]);
    }
    // get Total time of project from a past to this date 
    public function getTotalTimeWithDate($idUser, $idProject, $date)
    {
        // get idWork for table save_time
        $relate = Project_creator::where('idCreator', $idUser)->where('idProject', $idProject)->first();
        // get all columns has idWork
        $times = Save_time::where('idWork', $relate->id)->where('start_date', '<=', $date)->get();
        $total = 0;
        // count time through props hour
        foreach ($times as $time) {
            $total += $time->hour;
        }
        $project_creator = Project_creator::where('idProject', $idProject)->get();
        // total tile of project
        $totalTimeOfProject = 0;
        foreach ($project_creator as $item) {
            $times = Save_time::where('idWork', $item->id)->where('start_date', '<=', $date)->get();
            foreach ($times as $time) {
                $totalTimeOfProject += $time->hour;
            }
        }
        return response()->json(['total' => $total, 'totalProject' => $totalTimeOfProject]);
    }
    public function update($id)
    {
        $project = Project::find($id);
        if (!$project->finished) {
            $data =  $project->update(
                [
                    'finished' => now(),
                ]
            );
            if ($data) {
                foreach ($project->getRelate as $relate) {
                    $relate->getCreator->notify( new ChangeStateProject($project));
                }
            }

            return back()->with('success', 'プロジェクト' . $project->name . 'のステータスが変更されました');
        } else {
            $data = $project->update(
                [
                    'finished' => null
                ]
            );
            if ($data) {
                foreach ($project->getRelate as $relate) {
                    $relate->getCreator->notify( new ChangeStateProject($project));
                }
            }
            return back()->with('success', 'プロジェクト' . $project->name . 'のステータスが変更されました');
        }
    }
    public function detail($idProject, $idcreator)
    {
        // get idWork through idProject and idCreator to get all columns have idWork
        $relate = Project_creator::where('idCreator', $idcreator)->where('idProject', $idProject)->first();
        $events = array();
        $times = Save_time::where('idWork', $relate->id)->get();
        foreach ($times as $time) {

            $events[] = [
                'id'   => $time->id,
                'title' => $time->title,
                'hour' => $time->hour,
                'start' => $time->start_date,
                'end' => $time->end_date,
                'idWork' => $time->idWork
            ];
        }
        return view('admin.project.detail', ['events' => $events, 'relate' => $relate]);
    }
    public function maskAsRead($id)
    {
        $notification= Notification::find($id);
            $notification->update([
                'read_at'=>now()
            ]);
            return back();
    }
}
