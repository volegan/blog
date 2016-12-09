<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB; //query builder
use App\Http\Controllers\controller;
use Session;
use App\Post;
use App\Category;
use App\Tag;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a varialble and store all posts in it from db
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        //return a view and pass in the variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the form submition
        $this->validate($request, [
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'        => 'required',
            'featured_image' => 'sometimes|imag|'
        ]);

        //store to database with eloquent
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        //save image
        if($request->hasFile('featured_image')) {
            $img = $request->file('featured_image');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($img)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        //assosiation tags
        $post->tags()->sync($request->tags, false);

        //falsh Message success
        Session::flash('success', 'Your post has been published!');

        //redirect to a page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //create a variable and store a single post in it
        $post = Post::find($id);

        //pass in the variable to the view
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //create a variable and store a single post in it
        $post = Post::find($id);

        //categories
        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        //tags
        $tags = Tag::all();
        $tags2 = [];
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        //pass in the variable to the view
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the requested data
        $post = Post::find($id);


        $this->validate($request, [
            'title' => 'required|max:255',
            'slug'  => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'image'
        ]);



        //save the data to the database
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug  = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body  = Purifier::clean($request->input('body'));

        //check for updating photo
        if($request->hasFile('featured_image')) {
            //add the new photo
            $img = $request->file('featured_image');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($img)->resize(800, 400)->save($location);
            $oldfilename = $post->image;

            //update the database
            $post->image = $filename;

            //delete the database
            Storage::delete($oldfilename);
        }

        $post->save();

        //saving the tags + check if request array is empty or not
        if(isset($request->tags)) {
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync([]);
        }


        //set flash message with success
        Session::flash('success', 'Your post has been updated');

        //redirect with flash Message to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //create a variable and find the post and save it
        $post = Post::find($id);

        //for deleting many to manu relation
        $post->tags()->detach();

        //delete image
        Storage::delete($post->image);

        //delete the Post
        $post->delete();

        //session flash Message
        Session::flash('success', 'The post has deleted');

        //redirect to a view
        return redirect()->route('posts.index');
    }
}
