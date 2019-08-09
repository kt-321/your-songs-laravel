<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected $fillable = [
        "body", "user_id", "song_id",
    ];
    
    public function song()
    {
        return $this->belongsTo(Song::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
