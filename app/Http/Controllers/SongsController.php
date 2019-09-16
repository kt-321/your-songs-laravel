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
        $comments = $song->comments()->orderBy("created_at", "desc")->paginate(10);
        $user = \Auth::user();
        
        return view("songs.show",[
            "song" => $song,
            "user" => $user,
            "comments" => $comments,
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
        
        if($user->id === $song->user_id){
            $song->delete();
        }
        
        return redirect("users/". $user->id);
    }
    
    public function search(Request $request)
    {
        // 値を取得
        $title = $request->input("title");
        $artist_name = $request->input("artist_name");
        $music_age = $request->input("music_age");
        $order = $request->input("order");
        
        // 検索QUERY
        $query = Song::query();
        
        // もし「曲名」があれば
        if(!empty($title))
        {
            $query->where("title", "like", "%".$title. "%");
        }
        
        // もし「アーティスト名」があれば
        if(!empty($artist_name))
        {
            $query->where("artist_name", "like", "%".$artist_name. "%");
        }
        
        // もし「年代」が選択されていれば
        if(!empty($music_age))
        {
            $query->where("music_age", $music_age);
        }
        
        // 並び替えで「投稿が新しい順」が選択されていれば
        if($order == "created_at")
        {
            $query->orderBy("created_at", "desc");
        }
        // 並び替えで「お気に入りが多い順」が選択されていれば、
        elseif($order == "favorites_ranking")
        {
            $query->withCount("favorite_users")->orderBy("favorite_users_count", "desc");
        }
        // 並び替えで「コメントが多い順」が選択されていれば
        elseif($order == "comments_ranking")
        {
            $query->withCount("comments")->orderBy("comments_count", "desc");
        }
        
        // ページネーション
        $songs = $query->paginate(5);
        
        // 「曲の年代がユーザーの好きな音楽の年代と一致」または「アーティスト名がユーザーの好きなアーティスト名と部分一致」
        // である曲をユーザーへのおすすめ曲とする。
        $favorite_music_age = \Auth::user()->favorite_music_age;
        $favorite_artist = \Auth::user()->favorite_artist;
        
        $recommended_songs = Song::where("user_id","<>", \Auth::id())
        ->where(function($key)use($favorite_music_age, $favorite_artist){
            $key->where("music_age", $favorite_music_age)
            ->orWhere("artist_name", "like", "%".$favorite_artist. "%");
        })
        ->inRandomOrder()
        ->limit(12)
        ->get();
        
        $data = [
        "title" => $title,
        "artist_name" => $artist_name,
        "music_age" => $music_age,
        "order" => $order,
        "songs" => $songs,
        "recommended_songs" => $recommended_songs
        ];
        
        return view("songs.search", $data);
    }
    
    public function indexForAdmin()
    {   
        // 管理者権限を持ったユーザーが、投稿されている曲および削除済みの曲の一覧を見ることが出来る
        $songs = Song::all(); 
        $deleted = Song::onlyTrashed()->get(); 
    
        return view("songs.index_for_admin", [
            "songs" => $songs,
            "deleted" => $deleted,
        ]);
    }
    
    public function delete($id)
    {
        // 管理者権限を持ったユーザーが、投稿されている曲を削除できる
        Song::find($id)->delete();
        return redirect()->route("songs.indexForAdmin");
    }
    
    public function restore($id)
    {   
        // 管理者権限を持ったユーザーが、削除済みの曲を復活させることが出来る
        Song::onlyTrashed()->find($id)->restore();
        return redirect()->route("songs.indexForAdmin");
    }
    
    public function forceDelete($id)
    {   
        // 管理者権限を持ったユーザーが、削除済みの曲を完全に削除することが出来る
        Song::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route("songs.indexForAdmin");
    }
}
