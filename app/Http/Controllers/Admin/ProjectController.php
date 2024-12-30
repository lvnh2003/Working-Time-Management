<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\Project;
use App\Models\Project_Creator;
use App\Models\Save_time;
use App\Models\User;
use App\Notifications\AdminCreateProject;
use App\Notifications\AssignNewProject;
use App\Notifications\RemoveProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function create()
    {
        $clients =  Login::where('role', 2)->where('isActive', 1)->get();
        return view('admin.project.add', ['clients' => $clients]);
    }
    public function store(Request $request)
    {
        // check option not is default
        if ($request->idClient === 0) {
            return back()->with('error', 'クライアントを選択してください');
        }
        $project_name_exist = Project::where('idClient', $request->idClient)->where('name', $request->name)->first();
        if ($project_name_exist) {
            return back()->with('error', 'このプロジェクト名は使用されました');
        }
        $request->validate(
            [
                'idClient' => 'bail|required',
                'name' => 'bail|required'
            ]
        );
        $project = new Project();
        $data = $project->create($request->all());
        $data->getClient->notify(new AdminCreateProject($data));
        return redirect()->route('admin.customer');
    }
    public function detail($idProject, $idcreator)
    {
        // get idWork through idProject and idCreator to get all columns have idWork
        $relate = Project_Creator::where('idCreator', $idcreator)->where('idProject', $idProject)->first();
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
    public function listCreator($id)
    {
        // get all creator is joining this project
        $list = Project_Creator::where('idProject', $id)->get();
        return  DataTables::of($list)
            ->addColumn('progress', function (Project_Creator $relate) {
                return $relate->getTime();
            })
            ->addColumn('detail', function (Project_Creator $relate) {
                return route('admin.project.detail', ['idProject' => $relate->idProject, 'idCreator' => $relate->idCreator]);
            })
            ->addColumn('name', function (Project_Creator $relate) {
                return $relate->getCreator->name;
            })
            ->addColumn('avatar', function (Project_Creator $relate) {
                return $relate->getCreator->getAvatar() ? $relate->getCreator->getAvatar() : asset('assets/img/default-avatar.png');
            })
            ->make(true);
    }
    public function getProject($id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }
    public function assign($id)
    {
        // get all creator is joined
        $project_exist = Project_Creator::where('idProject', $id)->get();
        // convert a array just have idCreator
        $idCreator_exist = $project_exist->pluck('idCreator');
        // get all Creator is not joined before 
        $creators = User::select('*')->whereNotIn('id', $idCreator_exist)->whereHas('login', function ($query) {
            $query->where('role', 1)->where('isActive', 1);
        })->get();
        return view('admin.project.listCreator', ['creators' => $creators, 'id' => $id]);
    }
    public function assignCreator(Request $request, $id)
    {
        // create a relate between creator and project
        $pro_cre = new Project_Creator();
        $data = $pro_cre->create([
            'idProject' => $id,
            'idCreator' => $request->idCreator,
        ]);
        if ($data) {
            $data->getCreator->notify(new AssignNewProject($data->getProject));
        }
        return redirect()->route('admin.customer')->with('success', 'タスクを正常に割り当てる');
    }
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->getClient->notify(new RemoveProject($project));
        if ($project) {
            $project->delete();
            return response()->json(['success' => '削除された ' . $project->name, 'id' => $project->id]);
        }
        return response()->json(['error' => 'プロジェクトが検索がありません'], 404);
    }
}
