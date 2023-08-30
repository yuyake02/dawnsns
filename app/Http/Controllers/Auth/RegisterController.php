<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|unique:users',
            'password' => 'required|string|min:4|max:12|confirmed|regex:/^[a-zA-Z0-9]+$/',
            'password_confirmation' => 'required_with:password|string|min:4|max:12|regex:/^[a-zA-Z0-9]+$/',
        ], [
            'username.required' => '名前は必須項目です',
            'username.min' => '名前は4文字以上12文字以下で入力してください',
            'username.max' => '名前は12文字以下で入力してください',
            'mail.required' => 'メールアドレスは必須項目です',
            'mail.email' => 'メールアドレス形式で入力してください',
            'mail.min' => 'メールアドレスは4文字以上12文字以下で入力してください',
            'mail.max' => 'メールアドレスは12文字以下で入力してください',
            'mail.unique' => 'すでに登録されています',
            'password.required' => 'パスワードは必須項目です',
            'password.confirmed' => 'パスワードが一致していません',
            'password.min' => 'パスワードは4文字以上12文字以下で入力してください',
            'password.max' => 'パスワードは12文字以下で入力してください',
            'password.regex' => 'パスワードは英数字のみで入力してください',
            'password_confirmation.required_with' => '入力されたパスワードと相違しています',
            'password_confirmation.string' => 'パスワードの確認は必須項目です',
            'password_confirmation.min' => 'パスワードは4文字以上で入力してください',
            'password_confirmation.max' => 'パスワードは12文字以下で入力してください',
            'password_confirmation.regex' => 'パスワードは英数字のみで入力してください',
        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $request->session()->put('username', $data['username']);
            $this->validator($data);
            $this->create($data);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
