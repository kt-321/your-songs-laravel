<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request, $song_id)
    {
        \Auth::user()->favorite($song_id);
        return back();
    }
    
    public function destroy($song_id)
    {
        \Auth::user()->unfavorite($song_id);
        return back();
    }
}
