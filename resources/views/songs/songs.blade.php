{{ $songs->render("pagination::bootstrap-4") }}

<ul class="song-cards list-unstyled">
    @foreach($songs as $song)
        <li class="song-card px-2 py-3 mb-5 border">
            <!--曲タイトル-->
            <h3 class="song-title p-3 mb-4 text-center" style="word-wrap: break-word;"><i class="fas fa-music mr-3"></i>{!! nl2br(e($song->title)) !!}</h3>
            
            <div class="song-details">
                <!--曲情報-->
                <ul class="list-unstyled px-3">
                    <li class="mb-1" style="word-wrap: break-word;"><i class="fas fa-guitar mr-1"></i>アーティスト：{!! nl2br(e($song->artist_name)) !!}</li>
                    <li class="mb-1" style="word-wrap: break-word;"><i class="fas fa-history mr-1"></i>曲の年代：{!! nl2br(e($song->music_age)) !!}年代</li>
                    <li class="mb-1" style="word-wrap: break-word;">
                        @if($song->description)
                            <div>
                                <i class="far fa-comment-dots mr-1"></i>説明
                            </div>
                            
                            <div class="status-value balloon3 mx-auto my-auto">
                                <p style="word-wrap: break-word;">{!! nl2br(e($song->description)) !!}</p>
                            </div>
                        @endif
                    </li>
                    
                    <li class="mb-1 text-center">
                        @if($song->video_url)
                           <div class="text-left"><i class="fab fa-youtube mr-1"></i>映像</div>
                           <iframe class="song-video" src="https://www.youtube.com/embed/{!! nl2br(e($song->video_url)) !!}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                    </li>
                </ul>
            </div>
            
            <a href="{{ route("songs.show", ["song" => $song]) }}" class="btn btn-light d-block mx-2 my-3">続きを読む</a>
            
            <!--投稿者が自分でないときに限り投稿者情報を表示-->
            <div class="user-introduction ml-2">
                @if(Auth::id() == $song->user_id)
                <span class="badge badge-success ml-1">自分の投稿</span>
                @else
                <h4 class="user-info">投稿者情報</h4>
                <div class="user-details">
                    <ul class="list-unstyled px-3">
                        <li><a href="{{ route("users.show", ["id" => $song->user->id]) }}">{!! nl2br(e($song->user->name)) !!}</a></li>
                        
                        @if($song->user->age)
                        <li class="mb-0">{!! nl2br(e($song->user->age)) !!}代</li>
                        @else
                        <li class="mb-0"></li>
                        @endif
                        
                        @if($song->user->gender == 1)
                        <li class="mb-1" style="word-wrap: break-word;">男性</li>
                        @elseif($song->user->gender ==2)
                        <li class="mb-1" style="word-wrap: break-word;">女性</li>
                        @endif
                        
                        @if($song->user->favorite_music_age)
                        <li class="mb-1" style="word-wrap: break-word;">{!! nl2br(e($song->user->favorite_music_age)) !!}年代の音楽</li>
                        @endif
                        
                        @if($song->user->favorite_artist)
                        <li class="mb-1" style="word-wrap: break-word;">好きなアーティスト：{!! nl2br(e($song->user->favorite_artist)) !!}</li>
                        @endif
                    </ul>
                    
                    <a class="btn btn-success btn-sm" href="{{ route("users.show", ["id" => $song->user->id]) }}">プロフィール</a>
                </div>
                @endif
            </div>
            
            <div style="width:180px; margin-left:auto;">
                <ul class="list-unstyled">
                    <li class="mr-3">
                        <span class="text-muted" style="font-size:13px">  投稿  {{ $song->created_at }}</span>
                    </li>
                    <li class="mr-3">
                        @if($song->updated_at)
                        <span class="text-muted" style="font-size:13px">  更新  {{ $song->updated_at }}</span>
                        @endif
                    </li>
                </ul> 
            </div>
            
            <div class="ml-4 pr-2" style="display: flex; justify-content: flex-end;">
                @if(Auth::id() == $song->user_id)
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