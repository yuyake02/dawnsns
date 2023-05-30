<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function profile()
    {
        return view('users.profile');
    }

    //　ユーザー検索
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::query()
            ->where('username', 'LIKE', "%{$keyword}%")
            ->get();

        return view('users.search', compact('users', 'keyword'));
    }

    //　マイページ遷移
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        $user_flg = $request->path();
        $user_flg = preg_replace('/[^0-10000]/', '', $user_flg);

        return view('users.show', ['user' => $user, 'user_flg' => $user_flg]);
    }

    // フォローする
    public function follow(User $user)
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($user->id);
        if (!$is_following) {
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
            // フォローしていなければフォロー解除する
            $follower->unfollow($user->id);
        }
    }
}
