@extends('layouts.logout')

@section('content')
    <div id="clear" class="back-ground">
        <p class="add-text">{{ session('username') }}さん</p>
        <p class="add-text">ようこそ！DAWNSNSへ！</p>
        <br>
        <p class="add-text">ユーザー登録が完了しました。</p>
        <p class="add-text">さっそく、ログインをしてみましょう。</p>
        <p class="back-add"><a href="/login">ログイン画面へ</a></p>
    </div>
@endsection
