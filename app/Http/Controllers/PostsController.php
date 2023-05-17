<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
    //
    public function index()
    {
        //投稿内容を高順表示
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('posts.index', ['posts' => $posts]);
    }

    //新しい投稿フォームを表示する
    public function create()
    {
        return view('posts');
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

    //指定された投稿を表示
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    //投稿フォームを編集
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    //指定された投稿を更新
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'posts' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->body = $validatedData['posts'];
        $post->save();

        return redirect('posts.show', ['id' => $post->id]);
    }

    //指定された投稿を削除
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('posts');
    }
}
