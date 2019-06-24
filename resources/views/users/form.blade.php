<div class="form-group">
    <i class="fas fa-user-circle mr-1"></i>
    {!! Form::label("name", "名前") !!}
    {!! Form::text("name", old("name"), ["class" => "form-control"]) !!}
</div>
                
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
                
<div class="form-group">
    <i class="fas fa-unlock-alt mr-1"></i>
    {!! Form::label("password_confirmation", "パスワード（確認）") !!}
    {!! Form::password("password_confirmation", ["class" => "form-control"]) !!}
</div>