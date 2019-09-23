<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>YourSongs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset("/css/app.css") }}" type="text/css" rel="stylesheet">
        <link href="{{ asset("/css/style.css") }}" type="text/css" rel="stylesheet">
        <script src="{{ asset("/js/app.js") }}" defer></script>
    </head>
    
    <body>
        @include("commons.navbar")
        <div class="text-center title-welcome-page">
            <h1 class="app-title">Your Songs</h1>
        </div>
        
    　　<div class="container container-before-login p-4">      
            <div class="text-center">
                <h2 class="welcome-message">Welcome to the YourSongs !!</h1>
                <p class="about-test-login">ログインボタンからテストログインすることもできます。</p>
                <a href="{{ route("login") }}" class="btn btn-lg btn-primary"><i class="fas fa-sign-out-alt mr-1"></i>ログイン</a>
                <a href="{{ route("signup.get") }}" class="btn btn-lg btn-success"><i class="fas fa-user-plus mr-1"></i>新規登録</a>
                <p class="mt-3">「おすすめの曲」をシェアしよう</p>
                <p>「YourSongs」はあなたの好きな曲を紹介することができるサービスです。</p>
                <p>条件を指定することで、他のユーザーのおすすめ曲を検索することもできます。</p>
                <p>さまざまな年代の名曲を知ることで、新たな音楽の発見につなげましょう。</p>
            </div>
        </div>
        
        <footer class="mt-5">
            <small>&copy; 2019 YourSongs</small>
        </footer>
         
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>