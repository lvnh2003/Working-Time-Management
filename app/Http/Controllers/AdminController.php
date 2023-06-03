<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Mail\ActiveAccount;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
  public function getAllUsers()
  {
    $list = User::whereHas('login', function ($query) {
      $query->where('role', 1)->where('isActive', 1);
    })->get();
    return  DataTables::of($list)
      ->addColumn('project', function (User $object) {
        return "<span style='color:red; font-weight:bold'>" . $object->name . "</span>";
      })
      ->addColumn('avatar', function (User $user) {
        return $user->getAvatar();
      })
      ->rawColumns(['project'])
      ->make(true);
  }
  public function customer()
  {
    return view('admin.customer');
  }
  public function create()
  {
    return view('admin.customer.index');
  }
  public function storeCustomer(Request $request)
  {
    $check= User::where('email',$request->email)->first();
    if(!$check)
    {
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
            'isActive' => 0
  
          ]
        );
        // this route is link to active new account
        $route = route('active', $activeToken);
        if (Mail::to($login->email)->send(new ActiveAccount($route))) {
          return redirect()->route('admin.customer');
        }
    }
    
    }
    else
    {
      return redirect()->back()->with('error','Email exists');
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
}
