<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogtag;
use App\Models\Blogcategory;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-blog', ['only' => ['index','show']]);
        $this->middleware('permission:create-blog', ['only' => ['create','store']]);
        $this->middleware('permission:update-blog', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-blog', ['only' => ['destroy']]);
    }
    /**
     * Display a blog of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogs.index', [
            'active' => 'blog',
            'blogs' => Blog::with('blogcategory')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.add', [
            'active' => 'blog',
            'categories' => Blogcategory::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creating slug
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs',
            'desc' => 'required',
            'keywords' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'blogs_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if(!$file->move(public_path("storage/blogs"), $file_name)){   
                return back()->with('error', 'Error! Image can not be upload. Please try again.');
            }
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->desc = $request->desc;
        $blog->tags = $request->tags;
        $blog->blogcategory_id = $request->category_id;
        $blog->keyword = $request->keywords;
        $blog->image = $file_name;
        $blog->content = $request->content;
        $blog->save();

        $tags = explode(",",$request->tags);
        foreach($tags as $tag)
        {
            $tag_slug = (string) Str::of($tag)->slug('-');
            if(!Blogtag::where('slug', $tag_slug)->exists())
            {
                $btag = new Blogtag();
                $btag->title = $tag;
                $btag->slug = $tag_slug;
                $btag->save();
            }
        }

        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog has been added successfully.",            
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', [
            'active' => 'blog',
            'blog' => $blog,
            'categories' => Blogcategory::latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,'.$blog->id,
            'desc' => 'required',
            'blogcategory_id' => 'required',
            'keywords' => 'required',
            'content' => 'required',
            'image' => 'nullable|mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'blogs_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/blogs"), $file_name)){   
                if(is_file(public_path('storage/blogs/'.$blog->image))){
                    unlink(public_path('storage/blogs/'.$blog->image));
                }             
                $blog->image = $file_name;
            }
        }

        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->desc = $request->desc;
        $blog->keyword = $request->keywords;
        $blog->tags = $request->tags;
        $blog->blogcategory_id = $request->blogcategory_id;
        $blog->content = $request->content;
        $blog->save();

        $tags = explode(",",$request->tags);
        foreach($tags as $tag)
        {
            $tag_slug = (string) Str::of($tag)->slug('-');
            if(!Blogtag::where('slug', $tag_slug)->exists())
            {
                $btag = new Blogtag();
                $btag->title = $tag;
                $btag->slug = $tag_slug;
                $btag->save();
            }
        }
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog has been added successfully.",                   
            'img' => $blog->image == null ? '' : "<img class='rounded' src='". asset('storage/blogs/'.$blog->image)."' style='width: 50px'/>",            
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if(is_file(public_path('storage/blogs/'.$blog->image))){
            unlink(public_path('storage/blogs/'.$blog->image));
        }
        $blog->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.blogs.table', [
            'blogs' => Blog::with('blogcategory')->latest()->get(),
        ]);
    }
}
