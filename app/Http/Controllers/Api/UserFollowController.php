<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;

use App\Http\Controllers\Controller;

class UserFollowController extends Controller
{
    // ユーザーをフォローする
    public function store(Request $request, $id)
    {
        \Auth::user()->follow($id);
    }

    // ユーザーのフォローを外す
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
    }
}