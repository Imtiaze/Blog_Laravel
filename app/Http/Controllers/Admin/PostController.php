<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
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
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'image'     => 'required',
            'categories'=> 'required',
            'tags'      => 'required',
            'body'      => 'required',
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->title);

        if(isset($image)){
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName   = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check directory and make directory
            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }

            //resize image
            $postImage = Image::make($image)->resize(1600,1066)->stream();

            //Upload photo
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        } else {
            $imageName = "default.png";
        }

        $post = new Post();
        $post->user_id  =  Auth::id();
        $post->title    =  $request->title;
        $post->slug     =  $slug;
        $post->image    =  $imageName;
        $post->body     =  $request->body;
        if(isset($request->status)){
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Post Successfully Saved', 'Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.post.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'     => 'required',
            'image'     => 'image',
            'categories'=> 'required',
            'tags'      => 'required',
            'body'      => 'required',
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->title);

        if(isset($image)){
            //unique name
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //make dirctory or exist direcotry
            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            //delete old image
            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }
            //upload image
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        } else {
            $imageName = $post->image;
        }

        $post->user_id = $post->user_id;
        $post->title   = $request->title;
        $post->slug    = $slug;
        $post->image   = $imageName;
        $post->body    = $request->body;
        if(isset($request->status)){
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated', 'Success');
        return redirect()->route('admin.post.index');

    }

    /**
     * All Pending Post
     */
    public function pending() 
    {
        $posts = Post::where('is_approved', false)->get();
        return view('admin.post.pending', compact('posts'));
    }
    
    /**
     * Approve Pending Post
     */
    public function approval($id) 
    {
        $post = Post::findOrFail($id);
        
        if($post->is_approved == false){
            $post->is_approved = true;
            $post->save();
            Toastr::success('The Post is Published', 'Success');
            
        } 
        else{
            Toastr::info('The Post is already approved', 'Info');
        }
        return redirect()->route('admin.post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted', "success");
        return redirect()->route('admin.post.index');
    }
}
