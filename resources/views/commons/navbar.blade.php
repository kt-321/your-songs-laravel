<header>
    <nav class="navbar navbar-expand-sm navbar-dark">
        @if (Auth::check())
        <a class="navbar-brand" href="/home"><i class="fas fa-headphones-alt mr-1"></i>YourSongs</a>
        @else
        <a class="navbar-brand" href="/"><i class="fas fa-headphones-alt mr-1"></i>YourSongs</a>
        @endif
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav_bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav_bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <!--ログイン中のナビゲーションバー-->
                @if (Auth::check())
                    @if(Auth::user()->role === 5)
                    <li class="nav-item">
                        <a href="{{ url("/index-for-admin") }}" class="nav-link"><i class="fas fa-trash-alt mr-1"></i>曲の管理画面</a>
                    </li>
                    @endif
                    
                    <li class="nav-item"><a href="{{ url("songs") }}" class="nav-link"><i class="far fa-clock mr-1"></i>タイムライン</a></li>
                    <li class="nav-item"><a href="{{ url("search/songs") }}" class="nav-link"><i class="fas fa-music mr-1"></i>曲を検索</a></li>
                    <li class="nav-item"><a href="{{ url("search/users") }}" class="nav-link"><i class="fas fa-user mr-1"></i>ユーザーを検索</a></li>
                    <li class="nav-item"><a href="{{ url("songs/create") }}" class="nav-link"><i class="fas fa-plus mr-1"></i>曲を追加</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            @if(Auth::user()->image_url)  
                            <img src="{{ Auth::user()->image_url }}" alt="アイコン" class="circle3">
                            @endif
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right border-white">
                            <li class="dropdown-item"><a href="{{ route("users.show", ["id" => Auth::id()]) }}" class="text-white"><i class="fas fa-user-circle mr-1"></i>マイページ</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="{{ route("logout.get") }}" class="text-white"><i class="fas fa-sign-out-alt mr-1"></i>ログアウト</a></li>
                        </ul>
                    </li>
                    
                <!--ログアウト中のナビゲーションバー-->
                @else
                    <li class="nav-item"><a href="{{ route("login") }}" class="nav-link"><i class="fas fa-sign-in-alt mr-1"></i>ログイン</a></li>
                    <li class="nav-item"><a href="{{ route("signup.get") }}" class="nav-link"><i class="fas fa-user-plus mr-1"></i>新規登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>