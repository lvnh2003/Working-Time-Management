<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRequest;
use App\Mail\ActiveClient;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
  public function customer()
  {
    // return all user is client
    $clients = Login::where('role', 2)->where('isActive', 1)->get();
    return view('admin.customer', ['clients' => $clients]);
  }
  public function create()
  {
    return view('admin.customer.index');
  }
  public function storeCustomer(ValidateRequest $request)
  {
    // check email is existing 
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
        // send mail to new client url login and new account include email and password
        if (Mail::to($login->email)->send(new ActiveClient($route, $login, $request->password))) {
          return redirect()->route('admin.customer');
        }
      }
    } else {
      return redirect()->back()->with('error', 'このメールアドレスはすでに使われています');
    }
  }
}
