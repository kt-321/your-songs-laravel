<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;

use App\Comment;
use App\Song;

use App\Http\Controllers\Controller;

use Log;

class CommentsController extends Controller
{      
    // public function store(CreateCommentRequest $request, $id)
    public function store(Request $request, $sid)
    {
        $user = \Auth::user();
        $song = Song::find($sid);
        // Log::debug($song);
        // $request->merge(['user_id' => $user->id, 'song_id' => $song->id]);
        $request->merge(['user_id' => $user->id, 'song_id' => $song->id]);
        // $song->comments()->create($request->validated());
        $song->comments()->create($request->all());
    }
    public function update(Request $request, $sid, $cid)
    {
        $user = \Auth::user();
        $song = Song::find($sid);
        // Log::debug($song);
        // $request->merge(['user_id' => $user->id, 'song_id' => $song->id]);
        $comment = Comment::find($cid);
        Log::debug($comment);
        $request->merge(['user_id' => $user->id, 'song_id' => $song->id]);
        Log::debug($request);
        // $song->comments()->create($request->validated());
        $comment->update($request->all());
    }
 
    public function destroy($cid)
    {
        $comment = Comment::find($cid);
        
        if(\Auth::id() === $comment->user_id){
            $comment->delete();
        }
    }
}