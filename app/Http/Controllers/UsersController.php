<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersController extends Controller
{
    //
    public function profile()
    {
        return view('users.profile');
    }
    public function search()
    {
        return view('users.search');
    }
    //マイページ遷移のコントローラー
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return view('users.show', ['user' => $user]);
    }
}
