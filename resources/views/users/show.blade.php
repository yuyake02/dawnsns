@extends('layouts.login')

@section('content')

<hr style="border: none; border-top: 5px solid #D7D7D7;">

<div class="d-flex justify-content-end flex-grow-1">
  @if(Auth::id() != $user_flg)
  @if(Auth::user()->isFollowing($user->id))
  <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">

    {{ csrf_field() }}
    {{ method_field('DELETE')}}

    <button type="submit" class="btn btn-danger">フォローをはずす</button>
  </form>
  @else
      <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
        {{ csrf_field() }}

        <button type="submit" class="btn btn-primary">フォローする</button>
      </form>
  @endif
  @endif
</div>
<p>テスト</p>

@endsection
