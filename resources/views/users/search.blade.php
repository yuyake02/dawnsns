@extends('layouts.login')

@section('content')

<div class="user-search">
  <form action="{{ route('users.search') }}" method="GET"><input type="text" name="keyword" placeholder="ユーザー名"></form>
  <button>検索する</button>
</div>

@foreach ($users as $user)
@if ($user->id !== Auth::user()->id)

<div class="usersSearchList">
  <figure><img src="image/"></figure>
<p>{{ $user->username }}</p>
</div>

<div class="usersSearchButton">
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
