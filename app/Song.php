<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{   
    use SoftDeletes;
    
    // protected $fillable = ["user_id", "title", "artist_name", "music_age", "description", "image_url", "video_url", "deleted_at"];
    
    protected $guarded = [
        'id',
        "user_id",
        'created_at',
        'updated_at',
        "deleted_at"
    ];

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
