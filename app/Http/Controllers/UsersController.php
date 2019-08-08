<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

use App\User;
use App\Song;

class UsersController extends Controller
{
    public function search(Request $request)
    {   
        // 値を取得
        $name = $request->input("name");
        $age = $request->input("age");
        $gender = $request->input("gender");
        $favorite_music_age = $request->input("favorite_music_age");
        $favorite_artist = $request->input("favorite_artist");
        
        // 検索QUERY
        $query = User::query();
        
        // もし「名前」があれば
        if(!empty($name))
        {
            $query->where("name", "like", "%".$name. "%");
        }
        
        // もし「年齢」が選択されていれば
        if(!empty($age))
        {
            $query->where("age", "like", "%".$age. "%");
        }
        
        // もし「性別」が選択されていれば
        if(!empty($gender))
        {
            $query->where("gender", $gender);
        }
        
        // もし「好きな音楽の年代」が選択されていれば
        if(!empty($favorite_music_age))
        {
            $query->where("favorite_music_age", $favorite_music_age);
        }
        
        // もし「好きなアーティスト」があれば
        if(!empty($favorite_artist))
        {
            $query->where("favorite_artist", "like", "%".$favorite_artist. "%");
        }
        
        // ページネーション
        $users = $query->orderBy("created_at", "desc")->paginate(6);
        
        // 「好きな音楽の年代が一致」または「好きなアーティスト名が部分一致」
        // であるユーザーをログインユーザーへのおすすめユーザーとする。
        $my_favorite_music_age = \Auth::user()->favorite_music_age;
        $my_favorite_artist = \Auth::user()->favorite_artist;
        
        $recommended_users = User::where("id","<>",\Auth::id())
        ->where(function($query2)use($my_favorite_music_age, $my_favorite_artist){
            $query2->where("favorite_music_age", $my_favorite_music_age)
            ->orWhere("favorite_artist", "like", "%".$my_favorite_artist. "%");
        })
        ->inRandomOrder()
        ->limit(12)
        ->get();
    
        $data = [
        "name" => $name,
        "age" => $age,
        "gender" => $gender,
        "favorite_music_age" => $favorite_music_age,
        "favorite_artist" => $favorite_artist,
        "users" => $users,
        "recommended_users" => $recommended_users,
        ];
        
        return view("users.search", $data);
    }
    
    
    public function show(User $user)
    {
        $songs = $user->songs()->orderBy("created_at", "desc")->paginate(10);
        
        $data = [
            "user" => $user,
            "songs" => $songs,
        ];
        
        $data += $this->counts($user);
        
        return view("users.show", $data);
    }
    
    
    public function edit(User $user)
    {
        return view("users.edit", ["user" => $user]);
    }
    
    
    public function update(UpdateUserRequest $request, User $user)
    {   
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->favorite_music_age = $request->favorite_music_age;
        $user->favorite_artist = $request->favorite_artist;
        $user->comment = $request->comment;
        
        $user->save();
        
        return redirect("users/".$user->id);
    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        
        $data = [
            "user" => $user,
            "users" => $followings,
        ];
        
        $data += $this->counts($user);
        
        return view("users.followings", $data);
    }
    
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);
        
        $data = [
            "user" => $user,
            "users" => $followers,
        ];
        
        $data += $this->counts($user);
        
        return view("users.followers", $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(10);
        
        $data = [
            "user" => $user,
            "songs" => $favorites,
        ];
        
        $data += $this->counts($user);
        
        return view("users.favorites", $data);
    }
}
