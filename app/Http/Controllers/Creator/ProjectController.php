<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Project_Creator;
use App\Models\Save_time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // $id is idProject, creator is working in this project
    public function index($id,$idNofication=null)
    {   
        if($idNofication)
        {
            $notification= Notification::find($idNofication);
            $notification->update([
                'read_at'=>now()
            ]);
        }
        $project = Project::find($id);
        $events = array();
        // get all events through table save_times, this table has idWork in order to find a column have
        //  a key of project and key of creator, find all columns has idWork 
        $times = Save_time::whereHas('getRelate', function ($query) use ($id) {
            $query->where('idCreator', Auth::user()->idUser)->where('idProject', $id);
        })->get();
        // this data will be render in fullcalendar
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
        // this id will be use to save new event
        $idWork = Project_Creator::where('idProject', $id)->where('idCreator', Auth::user()->idUser)->first();
        if(!$idWork)
        {
            return view('error.404');
        }
        return view('user.project.index', ['events' => $events, 'id' => $idWork->id, 'project' => $project]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'bail|required',
            'hour'=>'bail|numeric|min:1|max:23|required'
        ],
        [
            'title.required' => 'タスクの内容を入力してください',
            'hour.required'=>'時間数を入力してください',
            'min'=>'無効な時間',
            'max'=>'無効な時間',
            'numeric'=>'時間は数値でなければなりません'
        ]
        );
        // get a data from ajax
        $time = Save_time::create([
            'hour' => $request->hour,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'idWork' => $request->idWork
        ]);
        // return a data saved into the database before to update UI of fullcalendar
        return response()->json([
            'id' => $time->id,
            'start' => $time->start_date,
            'end' => $time->end_date,
            'hour' => $request->hour,
            'title' => $request->title,
            'idWork' => $request->idWork
        ]);
    }
    public function update(Request $request, $id)
    {
        
        // have two option update event
        $time = Save_time::find($id);
        if (!$time) {
            return response()->json(['error' => 'Can not update'], 404);
        }
        if ($request->type) {
            $request->validate([
                'title'=>'bail|required',
                'hour'=>'bail|numeric|min:2|max:23|required'
            ],
            [
                'title.required' => 'タスクの内容を入力してください',
                'hour.required'=>'時間数を入力してください',
                'min'=>'無効な時間',
                'max'=>'無効な時間',
                'numeric'=>'時間は数値でなければなりません'
            ]
            );
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
