<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Song;

use App\Http\Controllers\Controller;

class FavoritesController extends Controller
{
    // 曲をお気に入りに登録
    public function bookmark(Request $request, $id)
    {
        \Auth::user()->favorite($id);
    }

    // 曲をお気に入りから外す
    public function removeBookmark(Request $request, $id)
    {
        \Auth::user()->unfavorite($id);
    }
}