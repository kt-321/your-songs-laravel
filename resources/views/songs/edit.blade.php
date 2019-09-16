<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>YourSongs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="../../css/style.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        @include("commons.navbar")
        
        <div class="container p-4">
            @include("commons.error_messages")

            <h1 class="text-center mb-4"><i class="fas fa-edit mr-1"></i>『{{ $song->title }}』の編集</h1>
            
            <div class="row">
                <div class="edit-form col-sm-6 offset-sm-3">
                    {!! Form::model($song, ["route" => ["songs.update", $song->id], "method" => "put"]) !!}
                       
                        @include("songs.form")
                    
                        {!! Form::submit("更新", ["class" => "btn btn-primary d-block m-auto"]) !!}
                        
                    {!! Form::close() !!}
                </div>
            </div>
        
        </div>
        
        <footer class="bg-dark mt-5">
            <small>&copy; 2019 YourSongs</small>
        </footer>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>