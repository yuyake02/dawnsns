@extends('layouts.login')

@section('content')

  <h1>Follower list</h1>

  @foreach($followersUsers as $user)
  <div class="followersUser">
    @if($user->images != 'dawn.png')
    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
    @else
    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
    @endif
  </div>
  @endforeach

  <hr style="border: none; border-top: 5px solid #D7D7D7;">

@endsection
