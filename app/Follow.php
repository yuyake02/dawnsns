<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'follow', 'follower'
    ];
    //Userモデルとのリレーション設定
    public function user()
    {
        return $this->belongsTo(User::class, 'follow');
    }
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower');
    }

    //Postモデルとのリレーション設定
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
