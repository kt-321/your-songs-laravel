@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media mb-3">
                <div class="media-left mx-4">
                    <figure>
                        <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                        <figcaption class="text-center m-0">
                            <a href="{{ route("users.show", ["id" => $user->id]) }}">{{ $user->name }}</a>
                        </figcaption>
                    </figure>
                </div>
                
                <div class="media-body row">
                    <div class="col-md-5">
                        @if($user->gender == 1)
                        <p class="mb-0">{!! nl2br(e($user->age)) !!}代男性 </p>
                        @else
                        <p class="mb-0">{!! nl2br(e($user->age)) !!}代女性 </p>
                        @endif
                       
                        <p class="mb-0">{!! nl2br(e($user->favorite_music_age)) !!}年代の音楽が好き</p>
                       
                        @if($user->favorite_artist)
                        <p class="mb-0">好きなミュージシャン：{!! nl2br(e($user->favorite_artist)) !!}</p>
                        @endif
                    </div>
                    
                    <div class="col-md-7">
                        <div class="d-inline-block">
                            @include("user_follow.follow_button", ["user" => $user])
                        </div>
                        <a class="btn btn-success btn-sm" href="{{ route("users.show", ["id" => $user->id]) }}">プロフィール</a>
                    </div>
                
                </div>
            </li>
        @endforeach
    </ul>
    {{ $users->render("pagination::bootstrap-4") }}
@endif