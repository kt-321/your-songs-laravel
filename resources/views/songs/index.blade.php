@extends("layouts.app")

@section("content")
    <h1 class="mb-4 text-center"><i class="far fa-clock mr-1"></i>タイムライン</h1>
    @include("songs.songs", ["songs" => $songs])
@endsection