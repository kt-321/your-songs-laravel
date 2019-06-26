@extends("layouts.app")

@section("content")
    <div class="text-center">
        <h1><i class="fas fa-sign-in-alt mr-2"></i>ログイン</h1>
    </div>
   
    <div class="row"> 
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(["route" => "login.post"]) !!}
                <div class="form-group">
                    <i class="far fa-envelope mr-1"></i>
                    {!! Form::label("email", "メールアドレス") !!}
                    {!! Form::email("email", old("email"), ["class" => "form-control"]) !!}
                </div>
                <div class="form-group">
                    <i class="fas fa-unlock-alt mr-1"></i>
                    {!! Form::label("password", "パスワード") !!}
                    {!! Form::password("password", ["class" => "form-control"]) !!}
                </div>
                
                {!! Form::submit("ログイン", ["class" => "btn btn-primary btn-block"]) !!}
            {!! Form::close() !!}
            
            <p class="mt-2">未登録の方は <a href="{{ route("signup.get") }}">こちら</a>から新規登録できます。</p>
        </div>
    </div>
@endsection