<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Project_creator;
use App\Models\Save_time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index($id)
    {
        $project=Project::find($id);
        $events = array();
        $times = Save_time::whereHas('getRelate',function($query) use ($id)
        {
            $query->where('idCreator',Auth::user()->idUser)->where('idProject',$id);
        })->get();
        foreach ($times as $time) {

            $events[] = [
                'id'   => $time->id,
                'title' => $time->title,
                'hour' => $time->hour,
                'start' => $time->start_date,
                'end' => $time->end_date,
                'idWork'=>$time->idWork
            ];
        }
        $idWork= Project_creator::where('idProject',$id)->where('idCreator',Auth::user()->idUser)->first()->id;
        return view('user.project.index', ['events' => $events,'id' => $idWork,'project' => $project]);
    }
    public function store(Request $request)
    {

        $time = Save_time::create([
            'hour' => $request->hour,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'idWork'=>$request->idWork
        ]);

        return response()->json([
            'id' => $time->id,
            'start' => $time->start_date,
            'end' => $time->end_date,
            'hour' => $request->hour,
            'title' => $request->title,
            'idWork'=>$request->idWork
        ]);
    }
    public function update(Request $request, $id)
    {
        $time = Save_time::find($id);
        if (!$time) {
            return response()->json(['error' => 'Can not update'], 404);
        }
        if ($request->title) {
            $time->update(
                [
                    'title' => $request->title,
                    'hour' => $request->hour,
                ]
            );
        } else {
            $time->update(
                [
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]
            );
        }



        return response()->json($time);
    }

    public function destroy($id)
    {
        $time = Save_time::find($id);
        if (!$time) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $time->delete();
        return $id;
    }
}
