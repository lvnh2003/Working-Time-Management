<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Project_creator;
use App\Models\Save_time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $client = User::find(Auth::user()->idUser);
        return view('client.index',['client' => $client]);
    }
    // get Total time of project from a past to this date 
    public function getTotalTimeWithDate($idUser,$idProject,$date)
    {
        // get idWork for table save_time
        $relate = Project_creator::where('idCreator',$idUser)->where('idProject',$idProject)->first();
        // get all columns has idWork
        $times= Save_time::where('idWork',$relate->id)->where('start_date','<=',$date)->get();
        $total=0;
        // count time through props hour
        foreach($times as $time)
        {
            $total+=$time->hour;
        }
        $project_creator = Project_creator::where('idProject',$idProject)->get();
        // total tile of project
        $totalTimeOfProject=0;
        foreach($project_creator as $item)
        {
            $times= Save_time::where('idWork',$item->id)->where('start_date','<=',$date)->get();
            foreach($times as $time)
            {
                $totalTimeOfProject+= $time->hour;
            }

        }
        return response()->json(['total' => $total,'totalProject'=>$totalTimeOfProject]);
    }
    public function update($id)
    {
        $project= Project::find($id);
        if(!$project->finished)
        {
            $project->update(
                [
                    'finished'=>now(),
                ]
            );
            return back()->with('success','プロジェクト'.$project->name.'のステータスが変更されました');
        }
        else
        {
            $project->update(
                [
                    'finished'=>null
                ]
            );
            return back()->with('success','プロジェクト'.$project->name.'のステータスが変更されました');
        }
        
    }
}
