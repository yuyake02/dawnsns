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
        'username', 'mail', 'password', 'images', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //　Postモデルとのリレーション設定
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //　followerモデルとのリレーション設定
    // searchでフォロー関係を取得するために必要
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower', 'follow');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow', 'follower');
    }

    // フォローする
    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除
    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか$user_id＝フォロー関係を確認したい対象のID
    public function isFollowing($user_id)
    {
        //条件に一致したユーザーの数を確認して取得
        //bool=カウントが１ならtrueを0ならfalseを返す
        return (bool) $this->follows()->where('follow', $user_id)->count();
    }

    // フォローされているか
    public function isFollowed($user_id)
    {
        return (bool) $this->followers()->where('follower', $user_id)->count();
    }

    //　フォロワー数表示のためのメソッド
    public function followersCount()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow', 'follower');
    }

    //　フォロー数表示のためのメソッド
    public function followingCount()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower', 'follow');
    }

    //　フォローフォロワー数を取得するヘルパーメソッド
    public function getFollowersCount()
    {
        return $this->followersCount()->count();
    }
    public function getFollowingCount()
    {
        return $this->followingCount()->count();
    }

    //　ハッシュ化されたパスワード
    public function getDisplayPasswordAttribute()
    {
        return '●●●●●●●●';
    }
}
