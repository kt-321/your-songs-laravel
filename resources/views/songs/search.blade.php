@extends("layouts.app")
    @section("content")

            <!--ページタイトル-->
            <h1 class="mb-4 text-center page-title"><i class="fas fa-music mr-3"></i>曲を検索</h1>
            
            <!--検索フォーム-->
            <form class="px-3">
                <div class="form-group">
                    <div class="row m-0">
                        <div class="col-sm-3 my-auto">
                            <label class="form-label m-0"><i class="fas fa-music mr-1"></i>タイトル</label>
                        </div>
                        
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="title" value="{{ $title }}" placeholder="タイトルを入力">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row m-0">
                        <div class="col-sm-3 my-auto">
                            <label class="form-label m-0"><i class="fas fa-guitar mr-1"></i>アーティスト名</label>
                        </div>
                        
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="artist_name" value="{{ $artist_name }}" placeholder="アーティスト名を入力">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row m-0">
                        <div class="col-sm-3 my-auto">
                            <label class="form-label m-0"><i class="fas fa-history mr-1"></i>年代</label>
                        </div>
                        
                        <div class="col-sm-4">
                            <select name="music_age" class="form-control select select-primary mbl" data-toggle="select">
                                <option value="">全て</option>
                                <option value="1970" @if($music_age=="1970") selected @endif>1970年代</option>
                                <option value="1980" @if($music_age=="1980") selected @endif>1980年代</option>
                                <option value="1990" @if($music_age=="1990") selected @endif>1990年代</option>
                                <option value="2000" @if($music_age=="2000") selected @endif>2000年代</option>
                                <option value="2010" @if($music_age=="2010") selected @endif>2010年代</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row m-0">
                        <div class="col-sm-3 my-auto">
                            <label class="form-label m-0"><i class="fas fa-sort-amount-down mr-1"></i>並び替え</label>
                        </div>
                        
                        <div class="col-sm-4">
                            <select name="order" class="form-control select select-primary mbl" data-toggle="select">
                                <option value="created_at" @if($order=="created_at") selected @endif>投稿が新しい順</option>
                                <option value="favorites_ranking" @if($order=="favorites_ranking") selected @endif>お気に入りが多い順</option>
                                <option value="comments_ranking" @if($order=="comments_ranking") selected @endif>コメントが多い順</option>
                            </select>
                        </div>
                    </div>
                </div>
             
                <div class="col-xs-offset-2 col-xs-10 text-center">
                    <button type="submit" class="btn btn-default btn-success">以上の条件で検索</button>
                </div>
            </form>
            
            <!--曲が見つからなかったときの表示-->
                @if($title != "" || $artist_name != "" || $music_age != "")
                    @if(count($songs) == 0)
                    <p class="text-center mt-3 mb-0">該当する曲は見つかりませんでした。</p>
                    @endif   
                @endif
            
            <!--ページネーション-->
                <div class="paginate text-center mt-3">
                    {{ $songs->appends(["title"=>$title, "artist_name"=>$artist_name, "music_age"=>$music_age])->render("pagination::bootstrap-4") }}
                </div>
            
            <!--該当する曲の一覧-->
                @if($songs)
                <ul class="song-cards list-unstyled mt-5">
                @foreach($songs as $song)
                    <li class="song-card px-2 py-2 mb-5 border">
                        
                        <!--曲タイトル-->
                        <h3 class="song-title p-3 mb-4 text-center"><i class="fas fa-music mr-3"></i>{!! nl2br(e($song->title)) !!}</h3>
                        
                        <div class="row m-0">
                            <div class="col-md-4 text-center">
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
                                    
                            <div class="col-md-8">
                                <!--曲情報-->
                                <ul class="list-unstyled px-3">
                                    <li class="song-item mb-1"><i class="fas fa-guitar mr-1"></i>アーティスト：{!! nl2br(e($song->artist_name)) !!}</li>
                                    <li class="song-item mb-1"><i class="fas fa-history mr-1"></i>曲の年代：{!! nl2br(e($song->music_age)) !!}年代</li>
                                    <li class="song-item mb-1">
                                        @if($song->description)
                                            <div>
                                                <i class="far fa-comment-dots mr-1"></i>説明
                                            </div>
                                            
                                            <div class="status-value balloon3">
                                                <p class="text-area">{!! nl2br(e($song->description)) !!}</p>
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
                        </div>
                        
                        <a href="{{ route("songs.show", ["song" => $song]) }}" class="btn btn-light d-block mx-2 my-3">続きを読む</a>
                        
                        <!--投稿者が自分でないときに限り投稿者情報を表示-->
                        <div class="about-user ml-2 mb-2">
                            @if(Auth::id() === $song->user_id)
                            <div class="col-sm-6">
                                <span class="badge badge-success ml-1">自分の投稿</span>
                            </div>
                            @else
                            <div class="col-md-6 py-2 user-information2">
                                <h4 class="user-information-title">投稿者情報</h4>
                                <div class="media">
                                    <div class="media-left ml-3 mr-3">
                                        <figure>
                                            @if($song->user->image_url)
                                                <img src="{{ $song->user->image_url }}" alt="画像" class="circle2" > 
                                            @elseif($song->user->gender == 1)
                                                <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/man.jpeg" alt="画像" class="circle2">
                                            @elseif($song->user->gender == 2)
                                                <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/woman.jpeg" alt="画像" class="circle2">
                                            @else
                                                <img src="https://original-yoursongs.s3-ap-northeast-1.amazonaws.com/qustion-mark.jpeg" alt="画像" class="circle2">
                                            @endif
                                            <figcaption class="text-center m-0">
                                                <a href="{{ route("users.show", ["id" => $song->user->id]) }}">{{ $song->user->name }}</a>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    
                                    <div class="media-body">
                                        <ul class="list-unstyled px-3">
                                            @if($song->user->age)
                                            <li class="mb-1">{!! nl2br(e($song->user->age)) !!}代</li>
                                            @endif
                                            
                                            @if($song->user->gender == 1)
                                            <li class="user-item mb-1">男性</li>
                                            @elseif($song->user->gender == 2)
                                            <li class="user-item mb-1">女性</li>
                                            @endif
                                            
                                            @if($song->user->favorite_music_age)
                                            <li class="user-item mb-1">{!! nl2br(e($song->user->favorite_music_age)) !!}年代の音楽が好き</li>
                                            @endif
                                            
                                            @if($song->user->favorite_artist)
                                            <li class="user-item mb-1">好きなミュージシャン：{!! nl2br(e($song->user->favorite_artist)) !!}</li>
                                            @endif
                                        </ul>
                                        
                                        <div class="d-inline-block">
                                            @include("user_follow.follow_button", ["user" => $song->user])
                                        </div>
                                        
                                        <a class="btn btn-success btn-sm btn-profile" href="{{ route("users.show", ["id" => $song->user->id]) }}">プロフィール</a>
                                    </div>
                                </div>
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
                        
                        <div class="d-flex ml-4 my-2">
                            @include("favorite.favorite_button", ["song" => $song])
                        </div>
                        
                        <div class="contributor-button ml-4 pr-2">
                            @if(Auth::id() === $song->user_id)
                                <a href="{{ route("songs.edit", ["id" => $song->id]) }}" class="btn btn-light mr-3 px-2 py-1">編集</a>
                            
                                {!! Form::open(["route" => ["songs.destroy", "$song->id"], "method" => "delete" ]) !!}
                                    {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm px-2 py-1", "onClick"=>"delete_alert();return false;"]) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                        
                        <!--管理者としてログインしている場合に限り曲を削除できる-->
                        @if(Auth::user()->role == 5 && Auth::id() !== $song->user->id)
                            <div class="buttons-delete-user mb-3 text-center">
                                <a class="btn btn-danger" href="/delete/{{ $song->id}}" onclick="delete_alert();return false;">この曲を削除</a>
                            </div>
                        @endif
                    </li>
                @endforeach
                </ul>
                @endif
                
                <div class="paginate text-center">
                    {{ $songs->appends(["title"=>$title,"artist_name"=>$artist_name, "music_age"=>$music_age, "order"=>$order])->render("pagination::bootstrap-4") }}
                </div>
                
                <!--おすすめ曲-->
                <!--Vue.jsを実装次第作成-->
    @endsection