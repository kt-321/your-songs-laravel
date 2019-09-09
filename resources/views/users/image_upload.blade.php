@extends("layouts.app")

@section("content")
<h1 class="mb-4 text-center page-title"><i class="fas fa-portrait mr-1"></i>アイコンの変更</h1>

<figure class="user-image text-center mb-5">
    @if($user->image_url) 
        <img src="{{ $user->image_url }}" alt="アイコン" class="circle1">
    @elseif($user->gender == 1)
        <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/man.jpeg" alt="アイコン" class="circle1">
    @elseif($user->gender == 2)
        <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/woman.jpeg" alt="アイコン" class="circle1">
    @else
        <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/user-icon.png" alt="アイコン" class="circle1">
    @endif
   
    <figcaption>
        <h2 class="user-name">{{ $user->name }}</h2>
        <div>
            @if(Auth::id() == $user->id) 
            {!! Form::open(["route" => ["users.imagesUpload", $user->id], "enctype" => "multipart/form-data"]) !!}
                    {!! Form::label("file", "画像", ["class" => "col-form-label d-none"]) !!}
                    {!! Form::file("file", ["class" => "form-control d-inline-block mb-1", "style" => "width: 320px;"]) !!}
                {!! Form::submit("選択した画像をアップする", ["class" => "btn btn-primary d-block m-auto"]) !!}
            {!! Form::close() !!}
            @endif
        </div>
    </figcaption>
</figure>

<div class="text-center">
    <a href="{{ route("users.show", ["id" => $user->id]) }}" class="btn btn-secondary btn-modify-profile">マイページに戻る</a>
</div>

@endsection
