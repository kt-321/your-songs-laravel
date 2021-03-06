<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

use App\User;
use App\Song;


use App\Http\Controllers\Controller;


class UsersController extends Controller
{   
    // ユーザー登録
    public function create(Request $request)
    {
        $valid = validator($request->only('email', 'name', 'password', 'password_confirmation'), [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        if ($valid->fails()) {
            $jsonError=response()->json($valid->errors()->all(), 400);
            return \Response::json($jsonError);
        }

        $data = request()->only('email','name','password');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 10,
            'remember_token' => null,
            'age' => null,
            'gender' => null,
            'image_url' => null,
            'favorite_music_age' => null,
            'favorite_artist' => null,
            'comment' => null
        ]);

        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => '6',
            'client_secret' => 'hqsU5vHqXaVVH85MdhZORkosxNCkeF3NURJkLwMp',
            'username'      => $data['email'],
            'password'      => $data['password'],
            'scope'         => null,
        ]);

        $token = Request::create(
            'oauth/token',
            'POST'
        );
        return \Route::dispatch($token);
    }

    // ユーザー一覧取得
    public function index(Request $request) {
        $users = User::all();
        return $users->transform(function($users) {
            return $users->append('is_followed');
        })
        ->toJson();
    }

    // ユーザー情報取得
    public function show($id)
    {
        $user = User::find($id);
        return $user->append('is_followed')->toJson();
    }

    // ユーザー情報更新
    public function update(UpdateUserRequest $request, $id)
    {   
        $user = User::find($id);
        $user->update($request->validated());
    }
}