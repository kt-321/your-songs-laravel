{{ $songs->render("pagination::bootstrap-4") }}

<ul class="song-cards list-unstyled">
    @foreach($songs as $song)
        <li class="song-card px-2 py-3 mb-5 border">
            <!--曲タイトル-->
            <h3 class="song-title p-3 mb-4 text-center"><i class="fas fa-music mr-3"></i>{!! nl2br(e($song->title)) !!}</h3>
            
            <div class="song-details">
                <!--曲情報-->
                <ul class="list-unstyled px-3">
                    <li class="song-item mb-1"><i class="fas fa-guitar mr-1"></i>アーティスト：{!! nl2br(e($song->artist_name)) !!}</li>
                    <li class="song-item mb-1"><i class="fas fa-history mr-1"></i>曲の年代：{!! nl2br(e($song->music_age)) !!}年代</li>
                    @if($song->description)
                    <li class="song-item mb-1">
                        <div class="song-description-label">
                            <i class="far fa-comment-dots mr-1"></i>説明
                        </div>
                        
                        <div class="song-description-value">
                            <p class="text-area">{!! nl2br(e($song->description)) !!}</p>
                        </div>
                    </li>
                    @endif
                    
                    @if($song->video_url)
                    <li class="song-item mb-1 text-center">
                       <div class="text-left mb-1"><i class="fab fa-youtube mr-1"></i>映像</div>
                       <iframe class="song-video" src="https://www.youtube.com/embed/{!! nl2br(e($song->video_url)) !!}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </li>
                    @else
                    <li class="song-item mb-1"><i class="fab fa-youtube mr-1"></i>映像はありません。</li>
                    @endif
                </ul>
            </div>
            
            <a href="{{ route("songs.show", ["song" => $song]) }}" class="btn btn-light d-block mx-2 my-3">続きを読む</a>
            
            <!--投稿者が自分でないときに限り投稿者情報を表示-->
            <div class="contributor-introduction ml-2">
                @if(Auth::id() === $song->user_id)
                <span class="badge badge-success ml-1">自分の投稿</span>
                @else
                <h4 class="contributor-introduction-label">投稿者情報</h4>
                <div class="user-details">
                    <ul class="list-unstyled px-3">
                        <li class="user-item mb-1"><a href="{{ route("users.show", ["id" => $song->user->id]) }}">{!! nl2br(e($song->user->name)) !!}</a></li>
                        
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
                        <li class="user-item mb-1">好きなアーティスト：{!! nl2br(e($song->user->favorite_artist)) !!}</li>
                        @endif
                    </ul>
                    
                    <a class="btn btn-success btn-sm" href="{{ route("users.show", ["id" => $song->user->id]) }}">プロフィール</a>
                </div>
                @endif
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
        </li>
    @endforeach
</ul>

{{ $songs->render("pagination::bootstrap-4") }}