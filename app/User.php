<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    public function followings() 
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
        
    }
    public function unfollow($userId)
    {
        $exists = $this->is_following($userId);
        
        $its_me =$this->id == $userId;
        
        if ($exists && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    public function feed_microposts()
    {
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    public function favor() 
    {
        return $this->belongsToMany(Micropost::class, 'micropost_favorite', 'user_id', 'favorite_id')->withTimestamps();
    }
    
    public function favorite($micropostId)
    {
        $exist = $this->is_favorite($micropostId);
        // 相手の呟きか
        $its_yours = $this->id == $micropostId;
        
        if ($exist || $its_yours){
            return false;
        } else {
            $this->favor()->attach($micropostId);
            return true;
        }
    }
    public function unfavorite($micropostId)
    {
        $exist = $this->is_favorite($micropostId);
        // 相手の呟きか
        $its_yours = $this->id == $micropostId;
        
        if ($exist && !$its_yours)
        {
            $this->favor()->detach($micropostId);
            return true;
        } else {
            return false;
        }
    }
    public function is_favorite($micropostId)
    {
        return $this->favor()->where('favorite_id', $micropostId)->exists();
    }
}