<?php

namespace App\Http\Controllers;

use App\Blog;
use Carbon\Carbon;
use App\BlogCategory;
use Image;
use Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('blogs.index',[

           'categories' => BlogCategory::all(),
       ]);
    }

    public function all()
    {
        return view('blogs.all', [
            'blogs' => Blog::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'blog_title'           => 'required',  
            'blog_description'     => 'required', 
            'blog_image'           => 'required|mimes:jpeg,jpg,png,gif,webp',
            'category_id'          => 'required',
            'posted_by'            => 'required',
        ]);

        $slug = Str::slug($request->blog_title);

        $blog = Blog::create([
            
            'blog_title'         => $request->blog_title,
            'blog_image'         => $request->blog_image,
            'blog_description'   => $request->blog_description,
            'category_id'        => $request->category_id,
            'posted_by'          => $request->posted_by,
            'blog_slug'          => $slug,
            'created_at'         => Carbon::now(),

        ]);
        
        $blog_image = $request->file('blog_image');
        $file_name = $blog->id. '.' .$blog_image->extension('blog_image');
        $location  =  public_path('uploads/blogs/'. $file_name);
        Image::make($blog_image)->resize(770, 350)->save($location);
        
        Blog::find($blog->id)->update([
            'blog_image' => $file_name,
            ]);
            
            return back()->withSuccess('Blogs Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        return view('blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {

        $request->validate([
            
            'blog_title'           => 'required',  
            'blog_description'     => 'required', 
            'blog_image'           => 'mimes:jpeg,jpg,png,gif,webp',
            'category_id'          => 'required',
            'posted_by'            => 'required',
        ]);

        
        if($request->hasFile('blog_image'))
        {
            $existing_image = public_path('uploads/blogs/'. $blog->blog_image);
            unlink($existing_image);

            $uploaded_image = $request->file('blog_image');
            $filename = $blog->id. '.' .$uploaded_image->extension('blog_image');
            $location = public_path('uploads/blogs/'. $filename);
            Image::make($uploaded_image)->resize(770,350)->save($location); 

            $blog->blog_image = $filename;
        }

          $slug = Str::slug($request->blog_title);

          $blog->blog_title          = $request->blog_title;
          $blog->blog_description    = $request->blog_description;
          $blog->blog_slug           = $slug;
          $blog->category_id         = $request->category_id;
          $blog->posted_by           = $request->posted_by;

          $blog->save();

          return redirect('/all/blogs')->withSuccess('Information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $image = public_path('uploads/blogs/'. $blog->blog_image);
        unlink($image);

        $blog->delete();

        return back()->withDanger('Blog deleted from the system !!!');
    }
}
