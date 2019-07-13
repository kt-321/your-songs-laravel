@if (Auth::user()->is_favoriting($song->id))
    {!! Form::open(["route" => ["favorites.unfavorite", $song->id], "method" => "delete"]) !!}
        <i class="fas fa-star favorite-orange"></i>
        {{ count($song->favorite_users) }}
        {!! Form::submit("登録済み", ["class" => "btn btn-warning btn-sm btn-unfavorite"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(["route" => ["favorites.favorite", $song->id]]) !!}
        <i class="fas fa-star"></i>
        {{ count($song->favorite_users) }}
        {!! Form::submit("登録する", ["class" => "btn btn-default btn-sm btn-favorite"]) !!}
    {!! Form::close() !!}
@endif