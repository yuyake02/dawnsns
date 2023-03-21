@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>
<div class='form-text'>
  <ul>
    <li>{{ Form::label('User Name') }}
      {{ Form::text('username',null,['class' => 'input','placeholder' => 'UserName']) }}
    </li>

    <li>{{ Form::label('Mail Adress') }}
      {{ Form::text('mail',null,['class' => 'input','placeholder' => 'MailAdress']) }}
    </li>

    <li>{{ Form::label('Password') }}
      {{ Form::text('password',null,['class' => 'input' , 'placeholder' => 'Password']) }}
    </li>

    <li>{{ Form::label('Password Confirm') }}
      {{ Form::text('password-confirm',null,['class' => 'input' , 'placeholder' => 'PasswordConfirm']) }}
    </li>
  </ul>
</div>
{{ Form::submit('register') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
