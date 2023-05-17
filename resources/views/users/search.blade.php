@extends('layouts.login')

@section('content')

@endsection

@foreach ($users as $user)
<p>{{ $user->name }}</p>
<p>{{ $user->email }}</p>
@endforeach
