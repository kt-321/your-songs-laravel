<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;


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
    
    public function update(UpdateUserRequest $request, $id)
    {   
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
