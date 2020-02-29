<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSongRequest;
use App\Http\Requests\UpdateSongRequest;

use App\Song;

use App\Http\Controllers\Controller;

class SongsController extends Controller
{   
    // 曲一覧取得
    public function index(Request $request) {
        $songs = Song::all();
        return $songs->toJson();
    }

    // 曲の追加
    public function store(CreateSongRequest $request)
    {   
        $user = \Auth::user();
        $user->songs()->create($request->all());
    }

    // 曲の更新
    public function update(UpdateSongRequest $request, $id)
    {
        $song = Song::find($id);
        $song->update($request->all());
    }
}