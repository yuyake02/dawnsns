<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Validator;

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
        // バリデーション
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|regex:/^[a-zA-Z0-9]+$/',
            'bio' => 'nullable|string|max:200',
            'newPassword' => 'nullable|string|min:4|max:12|regex:/^[a-zA-Z0-9]+$/',
        ], [
            'username.required' => '名前は必須項目です',
            'username.min' => '名前は4文字以上で入力してください',
            'username.max' => '名前は12文字以下で入力してください',
            'mail.required' => 'メールアドレスは必須項目です',
            'mail.min' => 'メールアドレス4文字以上で入力してください',
            'mail.email' => 'メールアドレスの形式が正しくありません',
            'images.image' => '画像を選択してください',
            'images.regex' => 'ファイル名は英数字のみで指定してください',
            'images.mimes' => '画像はjpeg, png, jpg, gif形式のいずれかでアップロードしてください',
            'bio.max' => '自己紹介は200文字以下で入力してください',
            'newPassword.min' => '新しいパスワードは4文字以上で入力してください',
            'newPassword.max' => '新しいパスワードは12文字以下で入力してください',
            'newPassword.regex' => '新しいパスワードは英数字のみで入力してください',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
