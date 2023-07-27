@extends('layouts.login')

@section('content')

<div class="user-search" style="display: flex;">
  <form action="{{ route('users.search') }}" method="GET"><input type="text" name="keyword" placeholder="ユーザー名"></form>
  <button><img src="/images/search.jpeg" width="41" height="36"></button>
</div>

<hr style="border: none; border-top: 5px solid #D7D7D7;">

@foreach ($users as $user)
@if ($user->id !== Auth::user()->id)

<div class="usersSearchList" style="display: flex;">

  <figure>
    @if($user->images != 'dawn.png')
    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
    @else
    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
    @endif
  </figure>

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
