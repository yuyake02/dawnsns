@extends('layouts.login')

@section('content')

  <h1>Follow list</h1>

  @foreach($followingUsers as $user)
  <div class="followUser">
    @if($user->images != 'dawn.png')
    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
    @else
    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
    @endif
  </div>
  @endforeach

  <hr style="border: none; border-top: 5px solid #D7D7D7;">

@endsection
