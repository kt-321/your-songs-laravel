@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media mb-3">
                <div class="media-left mx-4">
                    <figure>
                        @if($user->image_url)
                            <img src="{{ $user->image_url }}" alt="アイコン" class="circle2"> 
                        @elseif($user->gender == 1)
                            <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/man.jpeg" alt="アイコン" class="circle2">
                        @elseif($user->gender == 2)
                            <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/woman.jpeg" alt="アイコン" class="circle2">
                        @else    
                            <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/user-icon.png" alt="アイコン" class="circle2">
                        @endif
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
    <!--{{ $users->render("pagination::bootstrap-4") }}-->
@endif