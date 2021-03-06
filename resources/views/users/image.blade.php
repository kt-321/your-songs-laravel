<figure class="user-image text-center m-0">
    @if($user->image_url) 
        <img src="{{ $user->image_url }}" alt="アイコン" class="circle1">
    @elseif($user->gender == 1)
        <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/man.jpeg" alt="アイコン" class="circle1">
    @elseif($user->gender == 2)
        <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/woman.jpeg" alt="アイコン" class="circle1">
    @else    
        <img src="https://your-songs-laravel.s3-ap-northeast-1.amazonaws.com/user-icon.png" alt="アイコン" class="circle1">
    @endif
   
    <figcaption>
        @if(Auth::id() === $user->id)
        <div class="mt-2">
            <a href="{{ route("users.imagesUploadForm", ["id" => $user->id]) }}" class="btn btn-primary btn-modify-profile">アイコンを変更</a>
            <h2 class="text-center">{{ $user->name }}</h2>
        </div>
        @endif
    </figcaption>
</figure>