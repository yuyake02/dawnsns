@extends('layouts.login')

@section('content')

<div class="user-search">
  <form action="{{ route('users.search') }}" method="GET"><input type="text" name="keyword" placeholder="ユーザー名"></form>
  <button></button>
</div>

@foreach ($users as $user)
<p>{{ $user->username }}</p>
@endforeach

@endsection
