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
        //送信内容からkeywordパラメーターを取得して変数に代入
        $keyword = $request->input('keyword');
        //キーワードが含まれているユーザ名をusers変数に代入　クエリビルダー
        $users = User::query()
            ->where('username', 'LIKE', "%{$keyword}%")
            //クエリ実行
            ->get();

        return view('users.search', compact('users', 'keyword'));
    }

    //　マイページ遷移
    public function show(Request $request, $id)
    {
        // 特定ユーザーの情報を表示させるための処理
        $user = User::find($id);
        // 現在のリクエストのパスを代入
        $user_flg = $request->path();
        // パスから数字以外を除外
        $user_flg = preg_replace('/[^0-9]/', '', $user_flg);

        return view('users.show', ['user' => $user, 'user_flg' => $user_flg]);
    }

    // フォローする
    public function follow(User $user)
    {
        // ログインしているユーザーのIDを代入
        $followerId = auth()->user()->id;
        // フォローしているか確認
        if (!Auth::user()->isFollowing($user->id)) {
            // フォローしていない場合のみフォローを作成
            // Followモデル(Eloquent)モデルに対して新しいレコードを作成する
            Follow::create([
                // フォローされる側のID
                'follow' => $user->id,
                // フォローする側のID
                'follower' => $followerId,
            ]);
        }

        return redirect()->back();
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        // ログインしているユーザーを代入
        $followerId = auth()->user()->id;

        if (Auth::user()->isFollowing($user->id)) {
            // フォローしているユーザーIDの中からfollowカラムと$followerIdが一致するユーザーを削除
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
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|mimes:jpeg,png,jpg,gif,svg,bmp',
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
            'images.mimes' => '画像はjpeg, png, jpg, gif, bmp, svg形式のいずれかでアップロードしてください',
            'bio.max' => '自己紹介は200文字以下で入力してください',
            'newPassword.min' => '新しいパスワードは4文字以上で入力してください',
            'newPassword.max' => '新しいパスワードは12文字以下で入力してください',
            'newPassword.regex' => '新しいパスワードは英数字のみで入力してください',
        ]);
        // バリデーションが失敗したらエラー表示と元の内容を表示してリダイレクト
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        // リクエストにimagesという名前のファイルが含まれているかチェック
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            // 現在の日付と時間を含んで一意性の名前を生成して代入
            $filename = date('Ymd_His') . '_' . $image->getClientOriginalName();
            // 保存
            $image->storeAs('public/images', $filename);

            $user->images = $filename;
        }

        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->bio = $request->input('bio');
        // filled=入力が殻ではない場合にtrueとなる、bcrypt=ハッシュ関数
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
