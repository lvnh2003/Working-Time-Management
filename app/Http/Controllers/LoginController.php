<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Mail\ActiveAccount;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.login.index');
    }
    public function signup()
    {
        return view('user.login.signup');
    }
    public function login(Request $request)
    {
        // dd($request);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if (Auth::user()->isActive != 1) {
                return redirect()->back()->withErrors(['errorLogin' => 'Tài khoản của bạn đã bị khóa!']);
            } else {
                return redirect()->route('home');
            }
        }
        return redirect()->back()->withErrors(['errorLogin' => 'Email hoặc mật khẩu không chính xác!']);
    }
    public function signupAction(ValidateRequest $request)
    {
        $activeToken = base64_encode($request->email);
        // assign data equal request data
        $data = $request->all();
        $data['activeToken'] = $activeToken;
        unset($data['password']);
        // create user to save attibute
        $userModel = new User();
        $user = $userModel::create($data);
        if ($user) {
            $login = Login::create(
                [
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'idUser' => $user->id,
                    'role' => 1,
                    'isActive' => 0

                ]
            );
            // this route is link to active new account
            $route = route('active', $activeToken);
            if (Mail::to($login->email)->send(new ActiveAccount($route))) {
                return redirect()->route('login');
            }
        }
    }
    // get a link from mail to active the account
    public function active($token)
    {
        $user = User::where('activeToken', $token)->first();
        if ($user) {
            $userLogin = Login::where('idUser', $user->id)->first();
            $userLogin->update(['isActive' => 1]);
            if (Auth::loginUsingId($userLogin->id)) {
                return redirect()->route('signup');
            }
        }
    }
}
