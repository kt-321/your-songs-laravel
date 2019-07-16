<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>YourSongs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="../../css/style.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        @include("commons.navbar")
        
        <div class="container p-4">
            @include("commons.error_messages")
            
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
        </div>
        
        <footer class="bg-dark mt-5">
            <small>&copy; 2019 YourSongs</small>
        </footer>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
