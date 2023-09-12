@extends('layouts.login')

@section('content')
    <div class="user-search" style="display: flex;">
        {{-- 検索ワードをフォームで送信 --}}
        <form action="{{ route('users.search') }}" method="GET">
            <input type="text" name="keyword" placeholder="ユーザー名">
            <button><img src="/images/search.jpeg" width="41" height="36"></button>
            @if ($keyword)
                <span>検索ワード:{{ $keyword }}</span>
            @endif
        </form>
    </div>

    <hr style="border: none; border-top: 5px solid #D7D7D7;">

    @foreach ($users as $user)
        {{-- 変数から持ってきたユーザーidとログインしているユーザーIDが異なるとき --}}
        @if ($user->id !== Auth::user()->id)
            <div class="users-search-list" style="display: flex;">

                <figure class="search-image">
                    @if ($user->images != 'dawn.png')
                        <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
                    @else
                        <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
                    @endif
                </figure>

                <p class="search-name">{{ $user->username }}</p>

                {{-- ログインしているユーザーが指定したユーザーをフォローしているか確認 --}}
                <div class="search-follow-button">
                    @if (auth()->user()->isFollowing($user->id))
                        <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="post">
                            {{-- フォームにトークンを含める --}}
                            @csrf
                            {{-- デリートメソッドを使用してフォロワーリストから削除する --}}
                            @method('delete')
                            <input type="submit" class="unfollow-button" value="フォローをはずす">
                        </form>
                    @else
                        <form action="{{ route('follow', ['user' => $user->id]) }}" method="post">
                            @csrf
                            <input type="submit" class="follow-button" value="フォローする">
                        </form>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
@endsection
