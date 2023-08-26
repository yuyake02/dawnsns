<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $primaryKey = null;

    protected $fillable = [
        'follow', 'follower'
    ];

    public $timestamps = false;
    public $incrementing = false;
}
