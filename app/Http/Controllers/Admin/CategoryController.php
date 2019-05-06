<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           // 'category' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png'
        ]);
        //get the image from form
        $image = $request->file('image');
        $slug  = str_slug($request->category);
        
        if(isset($image)){
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check category directory
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            //resize image for category and upload
            $category = Image::make($image)->resize(1600, 479)->stream();
            //now save the image
            Storage::disk('public')->put('category/'.$imageName,$category);

            //check category/slider directory
            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //resize image for category and upload
            $slider = Image::make($image)->resize(500, 333)->stream();
            //now save the image
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);

        }
        else{
            $imageName = "default.png";
        }

        $cat = new Category();
        $cat->name = $request->category;
        $cat->slug = $slug;
        $cat->image = $imageName;

        $cat->save();
        Toastr::success('Category Added Successfully', 'Success');
        return redirect()->route('admin.category.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
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
        $this->validate($request, [
             'name' => 'required',
             'image' => 'mimes:jpeg,bmp,png'
         ]);
         //get the image from form
         $image = $request->file('image');
         $slug  = str_slug($request->name);
         $category = Category::findOrFail($id);
         
         
         if(isset($image)){
             //make unique name for image
             $currentDate = Carbon::now()->toDateString();
             $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
             //check category directory
             if(!Storage::disk('public')->exists('category')){
                 Storage::disk('public')->makeDirectory('category');
             }
             //Delete old Image
             if(Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/'.$category->image);
             }
             //resize image for category and upload
             $categoryImage = Image::make($image)->resize(1600, 479)->stream();
             //now save the image
             Storage::disk('public')->put('category/'.$imageName,$categoryImage);
 
             //check category/slider directory
             if(!Storage::disk('public')->exists('category/slider')){
                 Storage::disk('public')->makeDirectory('category/slider');
             }
             //Delete Slider Image
             if(Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
             }
             //resize image for category and upload
             $slider = Image::make($image)->resize(500, 333)->stream();
             //now save the image
             Storage::disk('public')->put('category/slider/'.$imageName,$slider);
 
         }
         else{
             $imageName = $category->image;
         }
 
         $category->name = $request->name;
         $category->slug = $slug;
         $category->image = $imageName;
 
         $category->save();
         Toastr::success('Category Added Successfully', 'Success');
         return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if(Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
         }
        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
         }

         return redirect()->route('admin.category.index');
    }
}
