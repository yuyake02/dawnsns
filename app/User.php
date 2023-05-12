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
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //Postモデルとのリレーション設定
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    //followerモデルとのリレーション設定
    public function follows()
    {
        return $this->hasMany(Follow::class, 'follower');
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'follow');
    }
}
