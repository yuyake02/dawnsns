@extends('layouts.login')

@section('content')

    @if($user->images != 'dawn.png')
    <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
    @else
    <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
    @endif

<form action="{{ route('user.update-profile') }}" enctype="multipart/form-data" method="post">
  @csrf
  <dl class="ProfileUpdate">
    <dt>UserName</dt>
    <dd><input type="text" name="username" value="{{ Auth::user()->username }}"></dd>
    <dt>MailAddress</dt>
    <dd><input type="text" name="mail" value="{{ Auth::user()->mail }}"></dd>
    <dt>Password</dt>
    <dd><input type="text" name="password" value="{{ $user->display_password }}" readonly></dd>
    <dt>NewPassword</dt>
    <dd><input type="password" name="newPassword" value="{{ $user->display_password }}"></dd>
    <dt>Bio</dt>
    <dd><input type="text" name="bio" value="{{ Auth::user()->bio }}"></dd>
    <dt>Icon Image</dt>
    <dd><input type="file" name="images"></dd>
  </dl>
  <input type="submit" name="profileUpdate" value="更新">
</form>

@endsection
