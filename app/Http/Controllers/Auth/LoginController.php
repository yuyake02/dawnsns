<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'mail' => 'required|email|exists:users,mail',
                'password' => 'required',
            ], [
                'mail.required' => 'メールアドレスは必須項目です',
                'mail.email' => 'メールアドレス形式で入力してください',
                'mail.exists' => 'メールアドレスが正しくありません',
                'password.required' => 'パスワードは必須項目です',
            ]);

            $data = $request->only('mail', 'password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if (Auth::attempt($data)) {
                return redirect('/top');
            }
        }
        return view("auth.login");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
