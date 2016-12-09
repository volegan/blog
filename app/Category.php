<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //tell laravel to use categories tsbel when use category Model
    protected $table = 'categories';

    //define the relationship
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
