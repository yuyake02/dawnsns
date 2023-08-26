@extends('layouts.logout')

@section('content')
    {!! Form::open() !!}
    <div class="back-ground">
        <h2>新規ユーザー登録</h2>
        <div class='form-text'>
            <ul>
                <li>{{ Form::label('User Name') }}</li>
                <li>
                    @error('username')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    {{ Form::text('username', null, ['class' => 'input', 'placeholder="dawntown"' => 'UserName']) }}
                </li>

                <li>{{ Form::label('Mail Adress') }}</li>
                <li>
                    @error('mail')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    {{ Form::text('mail', null, ['class' => 'input', 'placeholder="dawn@dawn.jp"' => 'MailAdress']) }}
                </li>

                <li>{{ Form::label('Password') }}</li>
                <li>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    {{ Form::input('password', 'password', null, ['class' => 'input', 'placeholder' => '●●●●●●●●']) }}

                </li>

                <li>{{ Form::label('Password Confirm') }}
                <li>
                    @error('password_confirmation')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    {{ Form::input('password', 'password_confirmation', null, ['class' => 'input', 'placeholder' => '●●●●●●●●']) }}

                </li>
            </ul>
        </div>
        <div class='submit-position'>
            <button type="submit" class="submit-button">REGISTER</button>
        </div>

        <p class="back-login"><a href="/login">ログイン画面へ戻る</a></p>
    </div>
    {!! Form::close() !!}
@endsection
