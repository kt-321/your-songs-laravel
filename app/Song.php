<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{   
    use SoftDeletes;
    
    protected $guarded = [
        'id',
        "user_id",
        'created_at',
        'updated_at',
        "deleted_at"
    ];

    // ログインユーザーによりお気に入り登録されているか否かという真偽値をJSONに追加
    protected $appends = ['is_bookmarked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function bookmarking_users()
    {
        return $this->belongsToMany(User::class, "favorites", "song_id", "user_id");
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // ログインユーザーがお気に入り登録している
    public function is_bookmarked()
    {   
        $user = \Auth::user();
        $userId = $user->id;
        return $this->bookmarking_users()->where("user_id", $userId)->exists();
    }
    // ログインユーザーにお気に入り登録されているか否かを返すためのアクセサ
    public function getIsBookmarkedAttribute()
    {
        $exist = $this->is_bookmarked();
        if ($exist){
            return true;
        } else {
            return false;
        }
    }
}
