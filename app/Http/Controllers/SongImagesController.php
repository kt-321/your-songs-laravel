<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\User;

use App\Song;

class SongImagesController extends Controller
{   
    public function uploadForm($id)
    { 
        $song = Song::find($id);
        return view("songs.image_upload", ["song" => $song]);
    }
    
    public function upload(Request $request)
    {
        $file = $request->file("file");
        
        $path = Storage::disk("s3")->putFile("/", $file, "public");
        
        $url = Storage::disk("s3")->url($path);
        
        $song = Song::find($request->id);
        $song->update(["image_url" => $url]);
        
        return redirect()->route('songs.show', ['id' => $song->id])->with("s3url", $url);
    }
}
