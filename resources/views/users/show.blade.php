@extends('layouts.login')

@section('content')
    <div class="users-profile">
        @if ($user->images != 'dawn.png')
            <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
        @else
            <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
        @endif
        <ul style="list-style: none; margin-left: 20px;">
            <li>Name</li>
            <li>{{ $user->username }}</li>
            <li>Bio</li>
            <li>{{ $user->bio }}</li>
        </ul>
    </div>
    <div class="d-flex justify-content-end flex-grow-1">
        {{-- URLパスから取得したユーザーと自身が同じではない場合の条件文 --}}
        @if (Auth::id() != $user_flg)
            {{-- フォローしているか確認 --}}
            @if (Auth::user()->isFollowing($user->id))
                {{-- ユーザーIDの値をルートに送る --}}
                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                    {{-- フォームでCSRFトークンを生成、削除リクエストを送信 --}}
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="unfollow-button">フォローをはずす</button>
                </form>
            @else
                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="follow-button">フォローする</button>
                </form>
            @endif
        @endif
    </div>

    <hr style="border: none; border-top: 5px solid #D7D7D7;">

    @foreach ($user->posts as $post)
        <ul>
            <li style="text-align: right;">{{ $post->created_at }}</li>

            <li>
                @if ($user->images != 'dawn.png')
                    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
                @else
                    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
                @endif
                <span>{{ $post->user->username }}</span>
            </li>

            <li>{{ $post->posts }}</li>

            <li
                style="display: flex; justify-content:flex-end; text-align: right;  border-bottom: 1px solid #D7D7D7; margin-bottom: 50px; padding: 30px;">
            </li>
        </ul>
    @endforeach

@endsection
