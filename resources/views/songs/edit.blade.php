@extends("layouts.app")

@section("content")
    <h1 class="text-center mb-4"><i class="fas fa-edit mr-1"></i>『{{ $song->title }}』の編集</h1>
    
    <div class="row">
        <div class="edit-form col-sm-6 offset-sm-3">
            {!! Form::model($song, ["route" => ["songs.update", $song->id], "method" => "put"]) !!}
               
                @include("songs.form")
            
                {!! Form::submit("更新", ["class" => "btn btn-primary d-block m-auto"]) !!}
                
            {!! Form::close() !!}
        </div>
    </div>
@endsection