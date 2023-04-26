@extends('layouts.login')

@section('content')
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="posts"></label>
    <img src="images/dawn.png">
    <textarea id="posts" name="posts" placeholder="何をつぶやこうか...?" row="4"></textarea>

    <button type="submit"><img src="images/post.png"></button>
</form>
<hr style="border: none; border-top: 5px solid #D7D7D7;">
<ul>
    @foreach($posts as $post)
    <li style="text-align: right;">{{ $post->created_at }}</li>
    @if(isset($post->user))
    <li><a href="{{ route('user.show', ["id" => $post->user_id]) }}"><img src="images/dawn.png"></a>{{ $post->user->username }}</li>
    @endif
    <li style="border-bottom: 1px solid #D7D7D7; margin-bottom: 50px; padding: 50px">{{ $post->posts }}</li>
    @endforeach
</ul>
@endsection
