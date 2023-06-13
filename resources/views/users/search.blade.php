@extends('layouts.login')

@section('content')

<div class="user-search" style="display: flex; justify-content: space-between;">
  <form action="{{ route('users.search') }}" method="GET"><input type="text" name="keyword" placeholder="ユーザー名"></form>
  <button>検索する</button>
  <p>検索結果：</p>
</div>

<hr style="border: none; border-top: 5px solid #D7D7D7;">

@foreach ($users as $user)
@if ($user->id !== Auth::user()->id)

<div class="usersSearchList" style="display: flex;  justify-content: space-between;">
  <figure>{{ $user->images }}</figure>
<p>{{ $user->username }}</p>

@if (auth()->user()->isFollowing($user->id))
<form action="{{ route('unfollow', ['user' => $user->id]) }}" method="post">
  @csrf
 @method('delete')
  <input type="submit" value="フォローをはずす">
</form>
@else
<form action="{{ route('follow', ['user' => $user->id]) }}" method="post">
  @csrf
  <input type="submit" value="フォローする">
</form>
@endif
</div>
@endif
@endforeach

@endsection
