<!DOCTYPE html>
<html>
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
	<header class="mb-4">
            <nav class="navbar navbar-expand-sm navbar-dark">
                <p class="navbar-brand mb-0"><i class="fas fa-headphones-alt mr-1"></i>YourSongs</p>
            </nav>
        </header>	

        <div class="container p-4" id="app">
	    @include("commons.error_messages")
	    
            <!--ページタイトル-->
            <h1 class="mb-4 text-center page-title">
                <i class="fab fa-youtube mr-3"></i>YouTube動画を検索
       	    </h1>
        
       	    <p>ビデオIDを曲投稿・編集画面の映像項目（URL）に貼り付けて使用してください。</p>
        
            <form method="GET">
            	<div>
            	    キーワード: <input type="search" id="q" name="q" placeholder="キーワードを入力">
          	</div>
          	<div>
            	    検索結果の最大表示数: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="12">
          	</div>
          	<input type="submit" value="検索">
            </form>
	   
    	    <!--該当するYouTube動画の一覧-->
    	    @if($videos)
    	    <h3>"{{ $keyword }}"の検索結果</h3>
    	    <div id="list" class="list row">
            	@foreach ($videos as $item)
        	<div class="col-md-6 col-lg-4">
            	    <div class="youtube-card card text-center">
                    	<iframe class="youtube-video mx-auto" src="https://www.youtube.com/embed/{{ $item->getId()->videoId }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                	<div class="card-body px-2 py-1">
                    	    <!--動画のタイトル-->
                    	    <h4 class="youtube-title">{{ $item->getSnippet()->title }}</h4>
                    
                    	    <!--動画の説明文-->
                    	    @if($item->getSnippet()->description)
                    	    <div class ="youtube-description mb-2">
                            	{{ $item->getSnippet()->description }}
                    	    </div>
                    	    @endif
                    
                   	    <span class="badge badge-pill badge-success">ビデオID</span>
                    	    <p>{{ $item->getId()->videoId }}</p>
                	</div> 
            	    </div>
        	</div>
        	@endforeach
    	    </div>
   	    @endif
        </div>    
    	
	<footer class="mt-5">
            <small>&copy; 2019 YourSongs</small>
    	</footer>
    
    	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
  </body>
</html>
