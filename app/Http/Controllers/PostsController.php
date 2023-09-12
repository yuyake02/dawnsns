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

        //ログインしているユーザーを取得　ユーザー情報を使用　画像表示とか
        $user = Auth::user();

        //投稿内容降順表示
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
        //idからPostモデル内の投稿内容特定
        $post = Post::find($request->id);
        //updateメソッドで投稿内容更新　リクエストで来た投稿内容を新しく更新
        $post->update(['posts' => $request->posts]);

        return redirect('top');
    }

    //指定された投稿を削除id指定
    public function destroy($id)
    {
        //idから投稿内容検索　デリートメソッドで削除
        $post = Post::find($id);
        $post->delete();

        return redirect('posts');
    }

    public function test()
    {
        $posts = Auth::user()->posts;

        return view('test', compact('posts'));
    }
}
