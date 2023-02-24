@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<p>DAWNSNSへようこそ</p>
<div class='form-text'>
  <ul>
    <li>{{ Form::label('Mail Adress') }}
      {{ Form::text('mail',null,['class' => 'input']) }}
    </li>
    <li>{{ Form::label('Password') }}
      {{ Form::password('password',['class' => 'input']) }}
    </li>
  </ul>
</div>
{{ Form::submit('LOGIN') }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
