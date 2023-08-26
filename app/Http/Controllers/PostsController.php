<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        // PostsとUsersテーブルを結合させてデータを取得する
        $posts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('posts.user_id', 'posts.id', 'users.username', 'users.id as user_id', 'posts.created_at')
            ->get();
        // ユーザー名を$name変数に格納
        foreach ($posts as $post) {
            $username = $post->username;
            // $postオブジェクトのnameプロパティにユーザー名を代入
            $post->username = $username;
        }

        $user = Auth::user();

        $posts = Post::orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', ['posts' => $posts], compact('user'));
    }

    //新しい投稿を保存する
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'posts' => 'required',
        ]);
        //ログインユーザーのIDを取得して、Postモデルに設定する
        $user_id = Auth::user()->id;
        $post = new Post;
        $post->user_id = $user_id;
        $post->posts = $validatedData['posts'];
        $post->save();

        return redirect('posts');
    }

    //指定された投稿を更新
    public function update(Request $request)
    {
        $post = Post::find($request->id);
        // dd($post);
        $post->update(['posts' => $request->posts]);

        return redirect('top');
    }

    //指定された投稿を削除
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('posts');
    }
}
