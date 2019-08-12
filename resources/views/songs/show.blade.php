@extends("layouts.app")

@section("content")
    <!--曲情報-->
    <section class="song-introduction mb-5">
        <h3 class="song-title text-center mb-3"><i class="fas fa-music mr-3"></i>{{ $song->title }}</h3>
        <div class="song-details row mx-0 mb-3">
            <div class="col-md-5 text-center">
                <!--曲画像-->
                <figure>
                        @if($song->image_url)
                            <img src="{{ $song->image_url }}" class="song-image img-thumbnail">
                        @else
                            <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/song.jpeg" class="song-image img-thumbnail">
                        @endif
                    
                    <figcaption>
                        <!--ログイン時、曲画像のアップロード-->
                        @if(Auth::id() === $song->user_id)
                        <div class="mt-2">
                            <a href="{{ route("songs.imagesUploadForm", ["id" => $song->id]) }}" class="btn btn-primary btn-modify-profile">画像を変更</a>
                        </div>
                        @endif
                    </figcaption>
                </figure>
            </div>
            
            <div class="col-md-7">
                <ul class="list-unstyled px-3">
                    <li class="song-item mb-2"><i class="fas fa-guitar mr-1"></i>アーティスト：{!! nl2br(e($song->artist_name)) !!}</li>
                    <li class="song-item mb-2"><i class="fas fa-history mr-1"></i>曲の年代：{!! nl2br(e($song->music_age)) !!}年代</li>
                    <li class="song-item mb-2">
                        @if($song->description)
                            <div class="song-description-label">
                                <i class="far fa-comment-dots mr-1"></i>説明
                            </div>
                        
                            <div class="song-description-value">
                                <p class="text-area">{!! nl2br(e($song->description)) !!}</p>
                            </div>
                        @endif
                    </li>
                    
                    @if($song->video_url)
                    <li class="song-item mb-1 text-center">
                        <div class="text-left mb-1"><i class="fab fa-youtube mr-1"></i>映像</div>
                        <iframe class="song-video" src="https://www.youtube.com/embed/{{ $song->video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>           
                    </li>
                    @else
                    <li class="song-item mb-0"><i class="fab fa-youtube mr-1"></i>映像はありません。</li>
                    @endif
                </ul>
           
                <!--投稿者が自分でないときに限り投稿者情報を表示-->
                <div class="contributor-introduction ml-2">
                    @if(Auth::id() === $song->user_id)
                    <div class="col-sm-6">
                        <span class="badge badge-success ml-1">自分の投稿</span>
                    </div>
                    @else
                    <div class="user-information1">
                        <h4 class="contributor-introduction-label">投稿者情報</h4>
                        <div class="user-details media">
                            <div class="media-left ml-3 mr-3">
                                <figure>
                                    @if($song->user->image_url)
                                        <img src="{{ $song->user->image_url }}" alt="アイコン" class="circle2"> 
                                    @elseif($song->user->gender == 1)
                                        <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/man.jpeg" alt="アイコン" class="circle2">
                                    @elseif($song->user->gender == 2)
                                        <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/woman.jpeg" alt="アイコン" class="circle2">
                                    @else
                                        <img src="https://original-yoursongs.s3-ap-northeast-1.amazonaws.com/qustion-mark.jpeg" alt="アイコン" class="circle2">
                                    @endif
                                    <figcaption class="text-center m-0">
                                        <a href="{{ route("users.show", ["id" => $song->user->id]) }}">{{ $song->user->name }}</a>
                                    </figcaption>
                                </figure>
                            </div>    
                            
                            <div class="media-body">
                                <ul class="list-unstyled px-3">
                                   @if($song->user->age)
                                    <li class="user-item mb-1">{!! nl2br(e($song->user->age)) !!}代</li>
                                    @else
                                    <li class="user-item mb-1"></li>
                                    @endif
                                    
                                    @if($song->user->gender == 1)
                                    <li class="user-item mb-1">男性</li>
                                    @elseif($song->user->gender == 2)
                                    <li class="user-item mb-1">女性</li>
                                    @endif
                                    
                                    @if($song->user->favorite_music_age)
                                    <li class="user-item mb-1">{!! nl2br(e($song->user->favorite_music_age)) !!}年代の音楽</li>
                                    @endif
                                    
                                    @if($song->user->favorite_artist)
                                    <li class="user-item mb-1">好きなミュージシャン：{!! nl2br(e($song->user->favorite_artist)) !!}</li>
                                    @endif
                                </ul>
                            
                                <div class="d-inline-block">
                                    @include("user_follow.follow_button", ["user" => $song->user])
                                </div>
                                
                                <a class="btn btn-success btn-sm" href="{{ route("users.show", ["id" => $song->user->id]) }}">プロフィール</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
            
        <div class="mt-2">
            @include("favorite.favorite_button", ["song" => $song])
        </div> 
            
        <div class="song-time ml-auto mb-1">
            <ul class="list-unstyled">
                <li class="mr-3">
                    <span class="post-time text-muted">  投稿  {{ $song->created_at }}</span>
                </li>
                <li class="mr-3">
                    @if($song->updated_at)
                    <span class="update-time text-muted">  更新  {{ $song->updated_at }}</span>
                    @endif
                </li>
            </ul> 
        </div>
        
        <div class="contributor-button ml-4 pr-2">
                @if(Auth::id() === $song->user_id)
                    <a href="{{ route("songs.edit", ["id" => $song->id]) }}" class="btn btn-light mr-3 px-2 py-1">編集</a>
                
                    {!! Form::open(["route" => ["songs.destroy", "$song->id"], "method" => "delete" ]) !!}
                        {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm px-2 py-1"]) !!}
                    {!! Form::close() !!}
                @endif
        </div>
        
    </section>
    
    <section class="comment">
        <div class="comments-index mb-5">
            
            @if(count($song->comments) > 0)
            <p class="comments-counts"><i class="far fa-comments mr-2"></i>コメント（{{ count($song->comments) }}）</p>
            @else
            <p>コメントはまだありません。</p>
            @endif
            
            <div class="comment-display">
                <ul class="list-unstyled">
                @foreach($comments as $comment)
                    <li class ="py-2 border-top">
                        <div class="d-flex">
                                <figure class="ml-3 mr-4 my-auto">
                                    @if($comment->user->image_url)
                                    <img src="{{ $comment->user->image_url }}" alt="画像" class="circle2"> 
                                    @elseif($comment->user->gender == 1)
                                    <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/man.jpeg" alt="画像" class="circle2">
                                    @elseif($comment->user->gender == 2)
                                    <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/woman.jpeg" alt="画像" class="circle2">
                                    @else
                                    <img src="https://original-yoursongs.s3-ap-northeast-1.amazonaws.com/qustion-mark.jpeg" alt="画像" class="circle2">
                                    @endif 
                                    <figcaption class="text-center m-0">
                                        <a class="comment-user-name" href="{{ route("users.show", ["id" => $comment->user->id]) }}">{{ $comment->user->name }}</a>
                                    </figcaption>
                                </figure>
                                
                                <div class="balloon-left ml-3 my-auto">
                                    <p>{{ $comment->body }}</p>
                                </div>
                        </div>    
                        
                        <div class="comment-side ml-auto mb-1">
                            <ul class="list-unstyled">
                                <li class="mr-3">
                                    <span class="post-time text-muted">  投稿  {{ $comment->created_at }}</span>
                                </li>
                                <li class="mr-3">
                                    @if(Auth::id() === $comment->user_id)
                                    {!! Form::open(["route" => ["comments.destroy", $comment->id], "method" => "delete"]) !!}
                                        {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm"]) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
            
            {{ $comments->render("pagination::bootstrap-4") }}
        </div>
    
        <div class="comment-post-form">        
            <h4 class="mb-3 text-center"><i class="far fa-comment mr-2"></i>コメントを投稿する</h2>
            
            <div class="comment-form">   
                    {!! Form::open(["route" => ["comments.store", $song->id]]) !!}
                        {!! Form::hidden("song_id", $song->id) !!}
                        {!! Form::hidden("user_id", $user->id) !!}
                        
                        
                        <div class="row m-0">
                            {!! Form::textarea("body", old("body"), ["class" => "form-control col-sm-8 offset-sm-2", "rows" => "4"]) !!}
                        </div>
                        
                        <div class="text-center m-3">
                            {!! Form::submit("投稿する", ["class" => "btn btn-primary"]) !!}
                        </div>   
                    {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection