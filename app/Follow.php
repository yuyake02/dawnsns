<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $primaryKey = [
        'follow',
        'follower'
    ];

    protected $fillable = [
        'follow', 'follower'
    ];

    public $timestamps = false;
    public $incrementing = false;

    //Postモデルとのリレーション設定
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
