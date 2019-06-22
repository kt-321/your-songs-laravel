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
                
<div class="form-group">
    <i class="fas fa-sort-numeric-up mr-1"></i>
    {!! Form::label("age", "年齢") !!}
    {!! Form::select("age", [10 => "10代", 20 => "20代", 30 => "30代", 40 => "40代", 50 => "50代", 60 => "60代", 70 => "70代"], old("age"), ["placeholder" => " － "]) !!}
</div>
                
<div class="form-group">
    <i class="fas fa-venus-mars mr-1"></i>
    {!! Form::label("gender", "性別") !!}
    {!! Form::select("gender", [1 => "男性", 2 => "女性"], old("gender"), ["placeholder" => " － "]) !!}
</div>
                
<div class="form-group">
    <i class="fas fa-history mr-1"></i>
    {!! Form::label("favorite_music_age", "好きな音楽の年代（任意）") !!}
    {!! Form::select("favorite_music_age", [1970 => "1970年代", 1980 => "1980年代", 1990 => "1990年代", 2000 => "2000年代", 2010 => "2010年代"], old("favorite_music_age"), ["placeholder" => " － "]) !!}
</div>
                
<div class="form-group">
    <i class="fas fa-guitar mr-1"></i>
    {!! Form::label("favorite_artist", "好きなミュージシャン（任意）") !!}
    {!! Form::text("favorite_artist", old("favorite_artist"), ["class" => "form-control"]) !!}
</div>
                
<div class="form-group">
    <i class="fas fa-user mr-1"></i><i class="far fa-comment-dots mr-1"></i>
    {!! Form::label("comment", "自己紹介（任意）") !!}
    {!! Form::textarea("comment", old("comment"), ["class" => "form-control"]) !!}
</div>