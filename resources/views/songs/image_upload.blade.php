@extends("layouts.app")

@section("content")
<h1 class="mb-4 text-center page-title"><i class="far fa-image mr-1"></i>曲の画像を変更</h1>

<!--曲画像-->
<figure class="song-image-change text-center mb-5">
    @if($song->image_url)
        <img src="{{ $song->image_url }}" class="song-image img-thumbnail">
    @else
        <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/song.jpeg" class="song-image img-thumbnail">
    @endif
    
    <figcaption>
        <!--ログイン時、曲画像のアップロード-->
        <h2 class="song-title"><i class="fas fa-music mr-3"></i>{{ $song->title }}</h2>
            @if(Auth::id() === $song->user_id)
                {!! Form::open(["route" => ["songs.imagesUpload", $song->id], "enctype" => "multipart/form-data"]) !!}
                        {!! Form::label("file", "画像", ["class" => "col-form-label d-none"]) !!}
                        {!! Form::file("file", ["class" => "form-control d-inline-block mb-1", "style" => "width: 320px;"]) !!}
                    {!! Form::submit("選択した画像をアップする", ["class" => "btn btn-primary d-block m-auto"]) !!}
                {!! Form::close() !!}
            @endif
    </figcaption>
</figure>

<div class="text-center">
    <a href="{{ route("songs.show", ["id" => $song->id]) }}" class="btn btn-secondary">曲の詳細画面に戻る</a>
</div>
   
@endsection