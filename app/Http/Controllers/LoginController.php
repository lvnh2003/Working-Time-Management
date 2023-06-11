<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Mail\ActiveAccount;
use App\Mail\ForgotAccount;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function Psy\debug;

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
                return redirect()->back()->withErrors(['errorLogin' => 'アカウントを有効にしてください!']);
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
        return redirect()->back()->withErrors(['errorLogin' => 'メールアドレスまたはパスワードが間違っている!']);
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
                    return redirect()->route('login')->with('success', '正常に登録するか、メールをチェックしてアカウントを確認します');
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
        else
        {
            return view('error.404');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function forgot()
    {
        return view('user.login.forgot');
    }
    public function sendMail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
            ],
            [
                'required' => 'メールを空白にすることはできません',
                'email' => '正しいメール形式を入力してください'
            ]
        );
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $route = route('reset', $user->activeToken);
            if (Mail::to($user->email)->send(new ForgotAccount($route))) {
                return redirect()->route('login')->with('success', 'メールをチェックして新しいパスワードを変更してください');
            }
        } else {
            return redirect()->back()->with('error', 'このメールアドレスはすでに使われています');
        }
    }
    public function reset($token)
    {
        $user = User::where('activeToken', $token)->first();
        if ($user) {
            return view('user.login.reset', ['user' => $user,'token' => $token]);
        }
        else
        {
            return view('error.404');
        }
    }
    public function update($token, Request $request)
    {
        $request->validate(
            [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'required' => 'パスワードを空白のままにしないでください',
                'min' => 'パスワードの長さが無効です',
                'confirmed' => 'パスワードの不一致'
            ]
        );
        $user = User::where('activeToken', $token)->first();
        if($user)
        {
            $user->login->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('login')->with('success', 'パスワードを正常に変更すると、ログインできます。');
        }
        else
        {
            return view('error.404');
        }
        
    }
}
