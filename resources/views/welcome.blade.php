@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the YourSongs</h1>
            <a href="{{ route("login") }}" class="btn btn-lg btn-primary"><i class="fas fa-sign-out-alt mr-1"></i>ログイン</a>
            <a href="{{ route("signup.get") }}" class="btn btn-lg btn-success"><i class="fas fa-user-plus mr-1"></i>新規登録</a>
        </div>
    </div>
    @endif
@endsection