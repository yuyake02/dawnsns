@extends('layouts.login')

@section('content')
    @if ($user->images != 'dawn.png')
        <img src="{{ asset('storage/images/' . $user->images) }}" width="50" height="50">
    @else
        <img src="{{ asset('/images/dawn.png') }}" width="50" height="50">
    @endif

    <form action="{{ route('user.update-profile') }}" enctype="multipart/form-data" method="post">
        @csrf
        <dl class="profileUpdate">
            <dt>UserName</dt>
            <dd><input type="text" name="username" value="{{ Auth::user()->username }}">
                @error('username')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </dd>
            <dt>MailAddress</dt>
            <dd><input type="text" name="mail" value="{{ Auth::user()->mail }}">
                @error('mail')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </dd>
            <dt>Password</dt>
            <dd><input type="text" name="password" placeholder="{{ $user->display_password }}" readonly>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </dd>
            <dt>NewPassword</dt>
            <dd><input type="password" name="newPassword" placeholder="{{ $user->display_password }}">
                @error('newPassword')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </dd>
            <dt>Bio</dt>
            <dd><input type="text" name="bio" value="{{ Auth::user()->bio }}">
                @error('bio')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </dd>
            <dt>Icon Image</dt>
            <dd><input type="file" name="images">
                @error('images')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </dd>
        </dl>
        <input type="submit" name="profileUpdate" value="更新">
    </form>

    @if (session('success'))
        <div class="alert alert-sucess">
            {{ session('success') }}
        </div>
    @endif
@endsection
