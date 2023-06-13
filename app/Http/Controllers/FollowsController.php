<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;

class FollowsController extends Controller
{
    //フォロー、フォロワーページ遷移
    public function followList()
    {
        $followingUsers = Auth::user()->followingCount;

        return view('follows.followList', compact('followingUsers'));
    }
    public function followerList()
    {
        $followersUsers = Auth::user()->followersCount;

        return view('follows.followerList', compact('followersUsers'));
    }
}
