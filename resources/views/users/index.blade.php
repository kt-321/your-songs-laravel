@extends("layouts.app")

@section("content")
    <h1 class="mb-4 text-center"><i class="fas fa-user mr-1"></i>ユーザー</h1>
    @include("users.users", ["users" => $users])
@endsection