<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        return view('follows.followList');
    }
    public function followerList()
    {
        return view('follows.followerList');
    }
    //フォロー情報をデータベースに保存
    public function follow(User $user)
    {

        $follow = Follow::create([
            'follow' => $user->id,
            'follower' => auth()->user()->id,
        ]);

        return back();
    }

    //フォロー情報をデータベースから削除
    public function unfollow(User $user)
    {
        $follow = Follow::where('follow', $user->id)
            ->where('follower', auth()->user()->id)
            ->first();

        $follow->delete();

        return back();
    }
}
