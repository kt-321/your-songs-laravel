<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
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
