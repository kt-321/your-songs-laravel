<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'role',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password", "remember_token",
    ];
    
     public function songs()
    {
        return $this->hasMany(Song::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, "user_follow", "user_id", "follow_id")->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, "user_follow", "follow_id", "user_id")->withTimestamps();
    }
    
    public function follow($userId)
    {   
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身でないかの確認
        $its_me = $this->id === $userId;
        
        if ($exist || $its_me){
            // すでにフォローしていれば何もしない
            return false;
        }else{
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身でないかの確認
        $its_me = $this->id === $userId;
        
        if ($exist && !$its_me){
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        }else{
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where("follow_id", $userId)->exists();
    }

    // ログイン中ユーザーがフォローしている
    public function is_followed()
    {   
        $user = \Auth::user();
        $userId = $user->id;
        return $this->followers()->where("user_id", $userId)->exists();
    }
    // ログイン中ユーザーがフォローしているか否かを返すためのアクセサ
    public function getIsFollowedAttribute()
    {
        $exist = $this->is_followed();
        if ($exist){
            return true;
        } else {
            return false;
        }
    }
    
    public function feed_songs()
    {
        $follow_user_ids = $this->followings()->pluck("users.id")->toArray();
        $follow_user_ids[] = $this->id;
        return Song::whereIn("user_id", $follow_user_ids);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Song::class, "favorites", "user_id", "song_id")->withTimestamps();
    }
    
    public function favorite($songId)
    {
        $exist = $this->is_favoriting($songId);
        
        if ($exist){
            return false;
        }else{
            $this->favorites()->attach($songId);
            return true;
        }
    }
    
    public function unfavorite($songId)
    {
        $exist = $this->is_favoriting($songId);
        
        if ($exist){
            $this->favorites()->detach($songId);
            return true;
        }else{
            return false;
        }
        
    }
    
    public function is_favoriting($songId)
    {
        return $this->favorites()->where("song_id", $songId)->exists();
    }
    
    public function accounts(){
        return $this->hasMany("App\LinkedSocialAccount");
    }
}
