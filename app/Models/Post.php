<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'pid';

    public function user()
    {
        return $this->belongsTo('App\User', 'uid', 'id');
    }
}
