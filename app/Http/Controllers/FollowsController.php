<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;

class FollowsController extends Controller
{
    // フォロー、フォロワーページ遷移
    public function followList()
    {
        // ログインしているフォロー数を取得
        $followingUsers = Auth::user()->followingCount;
        // Postモデルから投稿内容と投稿時間を取得して降順表示
        $posts = Post::orderBy('created_at', 'desc')
            ->get();

        return view('follows.followList', compact('followingUsers'), ['posts' => $posts]);
    }

    public function followerList()
    {
        $followersUsers = Auth::user()->followersCount;

        $posts = Post::orderBy('created_at', 'desc')
            ->get();

        return view('follows.followerList', compact('followersUsers', 'posts'));
    }
}
