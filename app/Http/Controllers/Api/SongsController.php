<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Http\Requests\CreateCommentRequest;

use App\Song;

use App\Http\Controllers\Controller;

class SongsController extends Controller
{      
    // 曲一覧取得
    public function index(Request $request) {
        $songs = Song::all();
        return $songs->transform(function($songs) {
            return $songs->append(['is_bookmarked', 'bookmarking_users', 'comments']);
        })
        ->toJson();
    }
    
    // 曲情報取得
    public function show($id) {
        $user = \Auth::user();
        $song = Song::find($id);
        return $song->append(['is_bookmarked', 'bookmarking_users', 'comments'])->toJson();
    }

    // 曲の追加
    public function store(CreateSongRequest $request)
    {   
        $user = \Auth::user();
        $user->songs()->create($request->validated());
    }

    // 曲の更新
    public function update(UpdateSongRequest $request, $id)
    {
        $song = Song::find($id);
        $song->update($request->validated());
    }

    // 曲の削除
    public function destroy($id)
    {  
        $user = \Auth::user();
        $song = Song::find($id);
        
        if($user->id === $song->user_id){
            $song->delete();
        }
    }
}