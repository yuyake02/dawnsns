@extends('layouts.login')

@section('content')
<h2><img src="images/dawn.png"></h2>
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="posts"></label>
    <textarea id="posts" name="posts"></textarea>

    <button type="submit">Create</button>
</form>
@endsection
