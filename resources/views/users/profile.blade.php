@extends('layouts.login')

@section('content')

<img src="{{ asset('storage/images/' .auth()->user()->images) }}" width="100" height="100">

<form action="{{ route('user.update-profile') }}" enctype="multipart/form-data" method="post">
  @csrf
  <dl class="UserProfile">
    <dt>UserName</dt>
    <dd><input type="text" name="username" value="{{ Auth::user()->username }}"></dd>
    <dt>MailAddress</dt>
    <dd><input type="text" name="mail" value="{{ Auth::user()->mail }}"></dd>
    <dt>Password</dt>
    <dd><input type="password" name="password"></dd>
    <dt>NewPassword</dt>
    <dd><input type="password" name="newpassword"></dd>
    <dt>Bio</dt>
    <dd><input type="text" name="bio" value="{{ Auth::user()->bio }}"></dd>
    <dt>icon image</dt>
    <dd><input type="file" name="images"></dd>
  </dl>
  <input type="submit" name="profileupdate" value="更新">
</form>

@endsection
