<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getIndex() {
        //fetch from db all plog posts
        $posts = Post::paginate(10);

        //return a view and pass in the object
        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug){
        // fetch from database
        $post = Post::where('slug', '=', $slug)->first();

        //return a view and pass in the object
        return view('blog.single')->withPost($post);
    }

}
