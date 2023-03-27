@extends('layouts.login')

@section('content')
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="posts"></label>
    <img src="images/dawn.png">
    <textarea id="posts" name="posts" placeholder="何をつぶやこうか...?"></textarea>

    <button type="submit"><img src="images/post.png"></=></button>
</form>
@endsection
