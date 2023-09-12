<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //モデルに対して許可された属性の配列を指定する
    protected $fillable = ['posts'];

    public function user()
    {
        //Userモデルとのリレーションを定義し、投稿に紐づくユーザー情報を取得する　
        return $this->belongsTo(User::class);
    }
}
