@extends("layouts.app")

@section("content")
    
@if(Auth::id() === $user->id)
<h1 class="mb-4 text-center"><i class="fas fa-user-circle mr-1"></i>マイページ</h1>
@else
<h1 class="mb-4 text-center"><i class="fas fa-user-circle mr-1"></i>{{ $user->name }}</h1>
@endif

<div class="user-profile">
    @include("users.image", ["user" => $user])
    
    <!--ユーザー情報-->
    <div class="status text-center mt-3" >
        <h4 class="mt-2"><i class="far fa-address-card mr-2"></i>プロフィール</h4>
        
        <ul class="status-list text-center px-3 py-3 m-auto">
            <li class="status-item-left">
                <div class="status-label">性別</div>
                @if($user->gender == 1)
                <div class="status-value">男性 </div>
                @elseif($user->gender == 2)
                <div class="status-value">女性</div>
                @else
                <div class="status-value">？</div>
                @endif
            </li>
            
            <li class="status-item">
                <div class="status-label">年齢</div>
                @if($user->age)
                <div class="status-value">{{ $user->age }}代</div>
                @else
                <div>？</div>
                @endif
            </li>
            
            @if($user->favorite_music_age)
            <li class="status-item">
                <div class="status-label">好きな年代</div>
                <div class="status-value">{{ $user->favorite_music_age }}年代</div>
            </li>
            @endif
            
            @if($user->favorite_artist)
            <li class="status-item">
                <div class="status-label">好きなアーティスト</div>
                <div class="status-value">{{ $user->favorite_artist}}</div>
            </li>
            @endif
        </ul>
        
        @if($user->comment)
        <div class="status-comment">
            <ul class="status-list text-center p-3 m-auto">
                <li class="status-item-introduction">
                    <div class="status-label mb-1">
                        <i class="fas fa-user mr-1"></i><i class="far fa-comment-dots mr-1"></i>自己紹介
                    </div>
                    
                    <div class="status-value self-introduction">
                        <p class="text-area">{{ $user->comment }}</p>
                    </div>
                </li>    
            </ul>
        </div>
        @endif  
    
        <!--自分のアカウントである場合に限り、プロフィール編集ボタンを表示-->
        @if(Auth::id() === $user->id)
        <div class="status edit my-1">
            <a href="{{ route("users.edit", ["id" => $user->id]) }}" class="btn btn-primary btn-modify-profile">プロフィールを編集</a>
        </div>
        @endif
    </div>
</div>     

<!--フォローボタンまたはフォロー解除ボタン-->
<div class="buttons-under-profile mb-3 text-center">
    @include("user_follow.follow_button", ["user" => $user])
</div>

<div class="mt-5">
    @include("users.navtabs", ["user" => $user])
    @if (count($users) > 0)
        @include("users.users", ["users" => $users])
    @endif
</div>

@endsection