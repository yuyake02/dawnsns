<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function follow(User $user)
    {
        //フォローするユーザーのIDを取得
        $followerId = auth()->id();
        //フォロー情報をデータベースに保存
        Follow::create([
            'follower_id' => $followerId,
            'follower_id' => $user->id,
        ]);
    }
    public function unfollow(User $user)
    {
        //フォロー解除するユーザーのIDを取得
        $followerId = auth()->id();
        //フォロー情報をデータベースから削除
        Follow::where('follower_id', $followerId)->where('follower_id', $user->id)->delete();
    }
}
