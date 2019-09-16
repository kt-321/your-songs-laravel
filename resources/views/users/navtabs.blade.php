<ul class="nav nav-tabs nav-justified mb-3">
    @if(Auth::id() === $user->id)
    <li class="nav-item"><a href="{{ route("users.show", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users/" . $user->id) ? "active" : ""}}"><i class="fas fa-music mr-2"></i>私のおすすめ曲<span class="badge badge-secondary ml-1"> {{ $count_songs }}</span></a></li>
    @else
    <li class="nav-item"><a href="{{ route("users.show", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users/" . $user->id) ? "active" : ""}}">おすすめ曲<span class="badge badge-secondary ml-1">{{ $count_songs }}</span></a></li>
    @endif
    <li class="nav-item"><a href="{{ route("users.followings", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users/*/followings") ? "active" : ""}}"><i class="fas fa-user"></i>フォロー中<span class="badge badge-secondary ml-1">{{ $count_followings }}</span></a></li>
    <li class="nav-item"><a href="{{ route("users.followers", ["id" => $user->id]) }}" class="nav-link {{ Request::is("users/*/followers") ? "active" : ""}}"><i class="fas fa-user"></i>フォロワー<span class="badge badge-secondary ml-1">{{ $count_followers }}</span></a></li>
    <li class="nav-item"><a href="{{ route("users.favorites", ["id" => $user->id])}}" class="nav-link {{ Request::is("users/*/favorites") ? "active" : ""}}"><i class="fas fa-star"></i> お気に入り <span class="badge badge-secondary ml-1">{{ $count_favorites }}</span></a></li>
</ul>