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
    
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, "favorites", "song_id", "user_id");
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
