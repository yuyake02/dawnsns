<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    public function updateProfile(Request $request)
    {
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $filename);

            $user = Auth::user();
            $user->images = $filename;
            $user->save();

            $user->update([
                'username' => $request->input('username'),
                'mail' => $request->input('mail'),
                'password' => bcrypt($request->input('newpassword')),
                'bio' => $request->input('bio')
            ]);

            return redirect()->back()->with('success', '更新完了');
        }

        return redirect()->back()->with('error', '更新失敗');
    }

    public function Profile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
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
}
