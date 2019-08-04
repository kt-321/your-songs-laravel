@extends("layouts.app")

@section("content")

    <h1 class="mb-4 text-center page-title"><i class="fas fa-user mr-1"></i>ユーザーを検索</h1>
    
    <!--検索フォーム-->
    <form class="px-3">
        <div class="form-group">
            <div class="row m-0">
                <div class="col-sm-3 my-auto">
                    <label class="form-label m-0">名前</label>
                </div>
                
                <div class="col-sm-5">
                    <input class="form-control" type="text" name="name" value="{{ $name }}" placeholder="名前を入力">
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="row m-0">
                <div class="col-sm-3 my-auto">
                    <label class="form-label m-0">年齢</label>
                </div>
                
                <div class="col-sm-4">
                    <select name="age" class="form-control select select-primary mbl" data-toggle="select">
                        <option value="">全て</option>
                        <option value="10" @if($age=="10") selected @endif>10代</option>
                        <option value="20" @if($age=="20") selected @endif>20代</option>
                        <option value="30" @if($age=="30") selected @endif>30代</option>
                        <option value="40" @if($age=="40") selected @endif>40代</option>
                        <option value="50" @if($age=="50") selected @endif>50代</option>
                        <option value="60" @if($age=="60") selected @endif>60代</option>
                        <option value="70" @if($age=="70") selected @endif>70代</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="row m-0">
                <div class="col-sm-3 my-auto">
                    <label class="form-label m-0">性別</label>
                </div>
                
                <div class="col-sm-4">
                    <select name="gender" class="form-control select select-primary mbl" data-toggle="select">
                        <option value="">全て</option>
                        <option value="1" @if($gender=="1") selected @endif>男性</option>
                        <option value="2" @if($gender=="2") selected @endif>女性</option>
                    </select>
                </div>
            </div>
        </div>
     
      <div class="col-xs-offset-2 col-xs-10 text-center">
          <button type="submit" class="btn btn-default btn-success">以上の条件で検索</button>
      </div>
    </form>
        
    <!--検索結果の表示-->
    @if($name != "" || $age != "" || $gender != "")
        @if(count($users) == 0)
        <p class="text-center mt-3 mb-0">該当する曲は見つかりませんでした。</p>
        @endif   
    @endif
            
    <!--ページネーション-->
    <div class="paginate text-center mt-3 mb-2">
        {{ $users->appends(["name"=>$name, "age"=>$age, "gender"=>$gender])->render("pagination::bootstrap-4") }}
    </div>
    
    
    <!--該当するユーザーの一覧-->
    @if(count($users))
    <div id="list" class="list row">
        @foreach ($users as $user)
        <div class="col-md-6 col-lg-4">
            <div class="user-card card text-center">
                    @if($user->image_url)
                        <img src="{{ $user->image_url }}" alt="アイコン" class="circle4 mx-auto"> 
                    @elseif($user->gender == 1)
                        <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/man.jpeg" alt="アイコン" class="circle4 mx-auto">
                    @elseif($user->gender == 2)
                        <img src="https://s3-ap-northeast-1.amazonaws.com/original-yoursongs/woman.jpeg" alt="アイコン" class="circle4 mx-auto">
                    @else    
                        <img src="https://original-yoursongs.s3-ap-northeast-1.amazonaws.com/qustion-mark.jpeg" alt="アイコン" class="circle4 mx-auto">
                    @endif
                    <a href="{{ route("users.show", ["id" => $user->id]) }}">{{ $user->name }}</a>
                <div class="card-body px-2 py-1">
                    @if($user->age)
                    <p class="mb-0">{!! nl2br(e($user->age)) !!}代</p>
                    @else
                    <p class="mb-0"></p>
                    @endif
                    
                    @if($user->gender == 1)
                    <p class="mb-0">男性 </p>
                    @elseif($user->gender == 2)
                    <p class="mb-0">女性 </p>
                    @endif
                    
                    @if($user->favorite_music_age)
                    <p class="mb-0"><i class="far fa-clock mr-1"></i>{!! nl2br(e($user->favorite_music_age)) !!}年代</p>
                    @endif
                   
                    @if($user->favorite_artist)
                    <p class="mb-0"><i class="fas fa-microphone mr-1"></i>{!! nl2br(e($user->favorite_artist)) !!}</p>
                    @endif
                    
                    <!--自己紹介-->
                    <div class ="self-introduction2">
                        @if($user->comment)
                        <p class="mb-0">{{ $user->comment }}</p>
                        @else
                        <p>（コメントなし）</p>
                        @endif
                    </div>
                </div>
                
                <!--フォロー・アンフォローボタンとプロフィールを見るボタン-->
                <div class="buttons">
                    <div class="d-inline-block">
                        @include("user_follow.follow_button", ["user" => $user])
                    </div>
                    <a class="btn btn-success btn-sm" href="{{ route("users.show", ["id" => $user->id]) }}">プロフィール</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!--ページネーション-->
    <div class="paginate text-center mt-3 mb-5">
        {{ $users->appends(["name"=>$name, "age"=>$age, "gender"=>$gender])->render("pagination::bootstrap-4") }}
    </div>

    <!--おすすめのユーザー-->
    <!--Vue.jsを導入後に記述を行う-->

@endsection