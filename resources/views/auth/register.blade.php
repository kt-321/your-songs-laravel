@extends("layouts.app")

@section("content")
    <div class="text-center">
        <h1><i class="fas fa-user-plus mr-2"></i>新規登録</h1>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(["route" => "signup.post"]) !!}
            
                @include("users.form")
                
               {!! Form::submit("上記の内容で登録", ["class" => "btn btn-primary btn-block"]) !!}
            {!! Form::close() !!}
            
            <a href="/login/github" class="btn-github btn btn-default btn-block mt-4"><i class="fab fa-github mr-1"></i>Githubアカウントで登録</a>
        </div>
    </div>
@endsection