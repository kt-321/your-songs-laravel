<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Song;

use App\Http\Controllers\Controller;

class SongsController extends Controller
{   
    // 曲一覧取得
    public function index(Request $request) {
        $songs = Song::all();
        return $songs->toJson();
    }
}