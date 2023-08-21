@extends('layouts.login')

@section('content')
    <h1>Follower list</h1>

    @foreach ($followersUsers as $user)
        <div class="followersUser">
            <a href="{{ route('users.show', ['id' => $user->id]) }}">
                @if ($user->images != 'dawn.png')
                    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
                @else
                    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
                @endif
            </a>
        </div>
    @endforeach

    <hr style="border: none; border-top: 5px solid #D7D7D7;">

    <ul>
        @foreach ($posts as $post)
            @if ($post->user_id !== Auth::id())
                <li style="text-align: right;">{{ $post->created_at }}</li>

                <li>
                    <a href="{{ route('users.show', ['id' => $post->user_id]) }}">
                        @if ($post->user->images != 'dawn.png')
                            <img src="{{ asset('storage/images/' . $post->user->images) }}" width="50" height="50">
                        @else
                            <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
                        @endif
                    </a>
                    {{ $post->user->username }}
                </li>

                <li>{{ $post->posts }}</li>

                <li
                    style="display: flex; justify-content:flex-end; text-align: right;  border-bottom: 1px solid #D7D7D7; margin-bottom: 50px; padding: 30px;">
                </li>
            @endif
        @endforeach
    </ul>
@endsection
