<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Mail\ActiveAccount;
use App\Mail\ActiveClient;
use App\Models\Login;
use App\Models\Project;
use App\Models\Project_creator;
use App\Models\Save_time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
  public function index()
  {
    return view('admin.index');
  }
  public function getAllUsers()
  {
    $list = User::whereHas('login', function ($query) {
      $query->where('role', 1)->where('isActive', 1);
    })->get();
    return  DataTables::of($list)
      ->addColumn('project', function (User $object) {

        $html = '';
        foreach ($object->getProjectOfCreator as $relate) {
          $html .= "<a class='btn btn-default' href='".route('admin.project.detail',['idProject'=>$relate->getProject->id,'idCreator'=>$object->id])."'>" . $relate->getProject->name . " : <span class=''>" .$relate->getTime()." 時間 </span></a>";
        }
        if (!$html == '') {
          return $html;
        }
        return "<span >No assign </span>";
      })
      ->addColumn('avatar', function (User $user) {
        return $user->getAvatar();
      })
      ->rawColumns(['project'])
      ->make(true);
  }
  public function customer()
  {
    $clients = Login::where('role', 2)->where('isActive', 1)->get();

    return view('admin.customer', ['clients' => $clients]);
  }
  public function create()
  {
    return view('admin.customer.index');
  }
  public function storeCustomer(ValidateRequest $request)
  {
    $check = User::where('email', $request->email)->first();
    if (!$check) {
      $activeToken = base64_encode($request->email);
      // assign data equal request data
      $data = $request->all();
      $data['activeToken'] = $activeToken;
      unset($data['password']);
      $userModel = new User();
      $user = $userModel::create($data);
      if ($user) {
        $login = Login::create(
          [
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'idUser' => $user->id,
            'role' => 2,
            'isActive' => 1

          ]
        );
        // this route is link to active new account
        $route = route('active', $activeToken);
        if (Mail::to($login->email)->send(new ActiveClient($route,$login,$request->password))) {
          return redirect()->route('admin.customer');
        }
      }
    } else {
      return redirect()->back()->with('error', 'このメールアドレスはすでに使われています');
    }
  }
  public function active($token)
  {
    $user = User::where('activeToken', $token)->first();
    if ($user) {
      $userLogin = Login::where('idUser', $user->id)->first();
      $userLogin->update(['isActive' => 1]);
      if (Auth::loginUsingId($userLogin->id)) {
        return redirect()->route('login');
      }
    }
  }
  public function createProject()
  {
    $clients =  Login::where('role', 2)->where('isActive', 1)->get();
    return view('admin.project.index', ['clients' => $clients]);
  }
  public function storeProject(Request $request)
  {
    if ($request->idClient === 0) {
      return back()->with('error', 'クライアントを選択してください');
    }
    $request->validate(
      [
        'idClient' => 'bail| required',
        'name' => 'bail|required'
      ]
    );
    $project = new Project();
    $project->create($request->all());
    return redirect()->route('admin.customer');
  }
  public function detail($idProject,$idcreator)
  {
    $relate=Project_creator::where('idCreator',$idcreator)->where('idProject',$idProject)->first();
    $events = array();
    $times= Save_time::where('idWork',$relate->id)->get();
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
    return view('admin.project.detail',['events'=>$events,'relate'=>$relate]);
  }
  public function listCreator($id)
  {
    $list = Project_creator::where('idProject', $id)->get();
    return  DataTables::of($list)
      ->addColumn('progress', function (Project_creator $relate) {
        return $relate->getTime();
      })
      ->addColumn('detail', function (Project_creator $relate) {
        return route('admin.project.detail', ['idProject' => $relate->idProject, 'idCreator' => $relate->idCreator]);
      })
      ->addColumn('name', function (Project_creator $relate) {
        return $relate->getCreator->name;
      })
      ->addColumn('avatar', function (Project_creator $relate) {
        return $relate->getCreator->getAvatar();
      })
      // ->rawColumns(['project'])
      ->make(true);
  }
  public function getProject($id)
  {
    $project = Project::find($id);
    return response()->json($project);
  }
  public function assign($id)
  {
    $project_exist = Project_creator::where('idProject', $id)->get();
    $idCreator_exist = $project_exist->pluck('idCreator');
    $creators = User::select('*')->whereNotIn('id', $idCreator_exist)->whereHas('login', function ($query) {
      $query->where('role', 1)->where('isActive', 1);
    })->paginate(3);
    return view('admin.project.listCreator', ['creators' => $creators, 'id' => $id]);
  }
  public function assignCreator(Request $request, $id)
  {
    $pro_cre = new Project_creator();
    $pro_cre->create([
      'idProject' => $id,
      'idCreator' => $request->idCreator,
    ]);
    return redirect()->route('admin.customer')->with('success', 'タスクを正常に割り当てる');
  }
  public function destroy($id)
  {
    $project = Project::find($id);
    if ($project) {
      $project->delete();
      return response()->json(['success' => 'Deleted '. $project->name,'id'=>$project->id]);
    }
    return response()->json(['error' => 'Project not found'], 404);
  }
}
