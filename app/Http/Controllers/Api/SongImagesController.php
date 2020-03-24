<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\UploadSongImageRequest;

use App\Song;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class SongImagesController extends Controller
{      
    // 曲への画像のアップロード
    public function upload(UploadSongImageRequest $request)
    {
        $file = $request->file("file");

        $path = Storage::disk("s3")->putFile("/", $file, "public");
        
        $url = Storage::disk("s3")->url($path);
        
        $song = Song::find($request->sid);
        $song->image_url =  $url;

        $song->save();
    }
}