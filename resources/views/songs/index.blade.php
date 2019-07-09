@extends("layouts.app")

@section("content")
    <!--<h1 class="mb-4 text-center"><i class="far fa-lightbulb mr-1"></i>新しく投稿された曲</h1>-->
    <h1 class="mb-4 text-center"><i class="far fa-clock mr-1"></i>タイムライン</h1>
    @include("songs.songs", ["songs" => $songs])
@endsection