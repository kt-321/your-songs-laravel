<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>YourSongs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('/css/app.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ asset('/css/style.css') }}" type="text/css" rel="stylesheet">
        <script src="{{ asset('/js/app.js') }}" defer></script>
    </head>
    
    <body>
        @include("commons.navbar")
      
        <div class="container p-4" id="app">
            @include("commons.error_messages")
            
            @yield("content")
        </div>
        
        <footer class="bg-dark mt-5">
            <small>&copy; 2019 YourSongs</small>
        </footer>
        
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>