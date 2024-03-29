@extends('layouts.logout')

@section('content')
    {!! Form::open() !!}

    <h1 style="font-size: 30px; color: #FFFEFE;">Social Network Service</h1>

    <div class="back-ground">
        <h2>DAWNSNSへようこそ</h2>
        <div class='form-text'>
            <ul>
                <li>{{ Form::label('Mail Adress') }}</li>
                <li> {{ Form::text('mail', null, ['class' => 'input', 'placeholder="dawn@dawn.jp"' => 'MailAdress']) }}
                    @error('mail')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </li>
                <li>{{ Form::label('Password') }}</li>
                <li> {{ Form::input('password', 'password', null, ['class' => 'input', 'placeholder' => '●●●●●●●●']) }}
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </li>
            </ul>
        </div>
        <div class='submit-position'>
            <button type="submit" class="submit-button">LOGIN</button>
        </div>


        <p class="back-login"><a href="/register">新規ユーザーの方はこちら</a></p>
    </div>

    {!! Form::close() !!}
@endsection
