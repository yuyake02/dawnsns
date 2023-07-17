@extends('layouts.login')

@section('content')
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="posts"></label>

    @if($user->images != 'dawn.png')
    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
    @else
    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
    @endif

    <textarea id="posts" name="posts" placeholder="何をつぶやこうか...?" row="4"></textarea>

    <button type="submit"><img src="images/post.png"></button>
</form>
<hr style="border: none; border-top: 5px solid #D7D7D7;">
<ul>
    @foreach($posts as $post)

    <li style="text-align: right;">{{ $post->created_at }}</li>

    <li>
        <a href="{{ route('users.show', ["id" => $post->user_id]) }}">
            @if($post->user->images != 'dawn.png')
            <img src="{{ asset('storage/images/' . $post->user->images) }}" width="50" height="50">
            @else
            <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
            @endif
        </a>
        {{ $post->user->username }}
    </li>

    <li>{{ $post->posts }}</li>

    <li style="display: flex; justify-content:flex-end; text-align: right;  border-bottom: 1px solid #D7D7D7; margin-bottom: 50px; padding: 30px;">
        <a href="{{ route('posts.edit', ['id' => $post->id]) }}"><img src="images/edit.png"></a>

        <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST" onsubmit="return confirm('このつぶやきを削除します。よろしいでしょうか？')";>
            @csrf
            @method('DELETE')
            <button type="submit"><img src="images/trash.png"></button>
        </form>
    </li>
    @endforeach
</ul>
@endsection
