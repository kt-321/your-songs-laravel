<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\UploadUserImageRequest;

use App\User;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class UserImagesController extends Controller
{      
    // 曲への画像のアップロード
    public function upload(UploadUserImageRequest $request)
    {
        $file = $request->file("file");

        $path = Storage::disk("s3")->putFile("/", $file, "public");
        
        $url = Storage::disk("s3")->url($path);
        
        $user= User::find(auth()->id());
        
        $user->image_url =  $url;
        $user->save();
    }
}