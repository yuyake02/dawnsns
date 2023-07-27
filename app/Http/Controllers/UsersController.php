<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follow;

class UsersController extends Controller
{
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
        $user_flg = preg_replace('/[^0-9]/', '', $user_flg);

        return view('users.show', ['user' => $user, 'user_flg' => $user_flg]);
    }

    // フォローする
    public function follow(User $user)
    {
        $followerId = auth()->user()->id;

        // すでにフォローしているかチェック
        // $isFollowing = Follow::where('follow', $user->id)
        //     ->where('follower', $followerId)
        //     ->exists();

        if (!Auth::user()->isFollowing($user->id)) {
            // フォローしていない場合のみフォローを作成
            Follow::create([
                'follow' => $user->id,
                'follower' => $followerId,
            ]);
        }

        return redirect()->back();
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $followerId = auth()->user()->id;

        if (Auth::user()->isFollowing($user->id)) {

            Follow::where('follow', $user->id)
                ->where('follower', $followerId)
                ->delete();
        }

        return redirect()->back();
    }

    //　プロフィール更新用のメソッド
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $filename);

            $user->images = $filename;
        }

        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->bio = $request->input('bio');

        if ($request->filled('newPassword')) {
            $user->password = bcrypt($request->input('newPassword'));
        }

        $user->save();

        return redirect()->back()->with('success', 'プロフィールを更新しました！');
    }

    //　ユーザー情報を$user変数に代入してビューへ渡す
    public function profile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }
}
