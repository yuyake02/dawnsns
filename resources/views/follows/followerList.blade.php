@extends('layouts.login')

@section('content')

  <h1>Follower list</h1>

  @foreach($followersUsers as $user)
  <div class="followersUser">
    <p>{{ $user->images }}</p>
  </div>
  @endforeach

  <hr style="border: none; border-top: 5px solid #D7D7D7;">

@endsection
