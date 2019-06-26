<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        
        return view("users.index", [
            "users" => $users,    
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        
        return view("users.show", [
            "user" => $user,
        ]);
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        
        return view("users.edit", ["user" => $user]);
    }
    
    public function update(Request $request, $id)
    {   
        $request->validate([
            "name" => "required|string|max:15",
            "email" => "required|string|email|max:30|unique:users,email,$id",
            "age" => "nullable|integer",
            "gender" => "nullable|string",
            "favorite_music_age" => "nullable|integer",
            "favorite_artist" => "nullable|string|max:20",
            "comment" => "nullable|string|max:150"
        ]);
        
        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->favorite_music_age = $request->favorite_music_age;
        $user->favorite_artist = $request->favorite_artist;
        $user->comment = $request->comment;
        
        $user->save();
        
        return redirect()->route("users.show", ["id" => $user->id]);
    }
}
