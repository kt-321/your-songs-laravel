<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;

use App\Comment;

class CommentsController extends Controller
{
    public function store(CreateCommentRequest $request)
    {
        Comment::create([
            "user_id" => $request->user()->id,
            "song_id" => $request->song_id,
            "body" => $request->body,
        ]);
       
        return back();
    }
    
    
    public function destroy($id)
    {
        $comment = Comment::find($id);
        
        if(\Auth::id() === $comment->user_id){
            $comment->delete();
        }
        
        return back();
    }
    
}
