@extends("layouts.app")

@section("content")
    <h1 class="text-center mb-4"><i class="fas fa-plus-circle mr-2"></i>おすすめ曲を追加</h1>
    
    <div class="row">
        <div class="create-form col-sm-6 offset-sm-3">
            {!! Form::open(["route" => "songs.store"]) !!}
               
                @include("songs.form")
                
                {!! Form::submit("投稿", ["class" => "btn btn-primary d-block m-auto"]) !!}
            {!! Form::close() !!}
        </div>
    </div>
    
@endsection