@extends('layouts.login')

@section('content')
<textarea id="posts" name="posts" placeholder="{{ $post->posts }}" row="4"></textarea>
<button><a href="{{ route('posts.update', ['id' => $post->id]) }}"><img src="images/edit.png"></a></button>
@endsection
