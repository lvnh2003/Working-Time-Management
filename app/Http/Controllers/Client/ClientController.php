<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project_creator;
use App\Models\Save_time;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $client = User::find(Auth::user()->idUser);
        return view('client.index',['client' => $client]);
    }
    public function getTotalTimeWithDate($idUser,$idProject,$date)
    {
        $relate = Project_creator::where('idCreator',$idUser)->where('idProject',$idProject)->first();
        $times= Save_time::where('idWork',$relate->id)->where('start_date','<=',$date)->get();
        $total=0;
        foreach($times as $time)
        {
            $total+=$time->hour;
        }
        $project_creator = Project_creator::where('idProject',$idProject)->get();
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
}
