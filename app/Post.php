<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //connect to the realtion in Category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
