<?php

namespace App\Http\Controllers;

use App\Models\Save_time;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $events = array();
        $times = Save_time::all();
        foreach ($times as $time) {

            $events[] = [
                'id'   => $time->id,
                'title' => $time->title,
                'hour' => $time->hour,
                'start' => $time->start_date,
                'end' => $time->end_date,
            ];
        }
        return view('user.project.index', ['events' => $events]);
    }
    public function store(Request $request)
    {

        $time = Save_time::create([
            'hour' => $request->hour,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'id' => $time->id,
            'start' => $time->start_date,
            'end' => $time->end_date,
            'hour' => $request->hour,
            'title' => $request->title,
            // 'color' => $color ? $color: '',

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
