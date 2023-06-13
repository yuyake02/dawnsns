@extends('layouts.login')

@section('content')

  <h1>Follow list</h1>

  @foreach($followingUsers as $user)
  <div class="followUser">
    <p>{{ $user->images }}</p>
  </div>
  @endforeach

  <hr style="border: none; border-top: 5px solid #D7D7D7;">

@endsection
