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
        // create fake user
        // $user = User::factory()->create();
        // $login = Login::factory()->state([
        //     'idUser' => $user->id,
        //     'email' => $user->email
        // ])->create();
        return view('user.login.login');
    }
    public function signup()
    {
        return view('user.login.signup');
    }
    public function login(Request $request)
    {
        //    check password and email
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // check creator is active account before
            if (Auth::user()->isActive != 1) {
                return redirect()->back()->withErrors(['errorLogin' => 'Tài khoản của bạn đã bị khóa!']);
            } else {
                // login with what role
                if (Auth::user()->role == 1) {
                    return redirect()->route('home');
                } else if (Auth::user()->role == 2) {
                    return redirect()->route('client.index');
                } else {
                    return redirect()->route('admin.index');
                }
            }
        }
        return redirect()->back()->withErrors(['errorLogin' => 'Email hoặc mật khẩu không chính xác!']);
    }
    public function signupAction(ValidateRequest $request)
    {
        $check = User::where('email', $request->email)->first();
        if (!$check) {
            // hash email to create a token for creator active their account
            $activeToken = base64_encode($request->email);
            // declare data equal request data
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
                        // default just creator can signup
                        'role' => 1,
                        'isActive' => 0

                    ]
                );
                // this route is link to active new account
                $route = route('active', $activeToken);
                // mail to create notification with a button active account
                if (Mail::to($login->email)->send(new ActiveAccount($route, $user))) {
                    return redirect()->route('login')->with('succes', '正常に登録するか、メールをチェックしてアカウントを確認します');
                }
            }
        } else {
            return redirect()->back()->with('error', 'このメールアドレスはすでに使われています');
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
                return redirect()->route('login');
            }
        }
    }
}
