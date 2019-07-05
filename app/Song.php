<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ["user_id", "title", "artist_name",  "music_age", "description", "image_url", "video_url",];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
