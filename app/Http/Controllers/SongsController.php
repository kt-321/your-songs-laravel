<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSongRequest;
use App\Http\Requests\UpdateSongRequest;

use Illuminate\Support\Facades\Storage;

use App\User;
use App\Song;

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $songs = $user->feed_songs()->orderBy("created_at", "desc")->paginate(5);

            $data = [
                "user" => $user,
                "songs" => $songs,
            ];
            $data += $this->counts($user);
        }
        return view("songs.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        return view("songs.create", ["user" => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSongRequest $request)
    {
        $user = \Auth::user();
        
        $request->user()->songs()->create([
            "title" => $request->title,
            "artist_name" => $request->artist_name,
            "music_age" => $request->music_age,
            "description" => $request->description,
            "video_url" => $request->video_url,
        ]);
        
        return redirect("users/".$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        $user = \Auth::user();
        
        return view("songs.show",[
            "song" => $song,
            "user" => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        return view("songs.edit",["song" => $song]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
        $song->title = $request->title;
        $song->artist_name = $request->artist_name;
        $song->music_age = $request->music_age;
        $song->description = $request->description;
        $song->video_url = $request->video_url;
        
        $song->save();
        
        return redirect("songs/".$song->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $user = \Auth::user();
        
        if($user->id=== $song->user_id){
            $song->delete();
        }
        
        return redirect("users/". $user->id);
    }
}
