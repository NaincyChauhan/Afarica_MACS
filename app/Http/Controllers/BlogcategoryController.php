<?php

namespace App\Http\Controllers;

use App\Models\Blogcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogcategoryController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-blogcategory', ['only' => ['index','show']]);
        $this->middleware('permission:create-blogcategory', ['only' => ['create','store']]);
        $this->middleware('permission:update-blogcategory', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-blogcategory', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogcategories.index', [
            'active' => 'blogcategory',
            'categories' => Blogcategory::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $request->slug = (string) Str::of($request->name)->slug('-');
        }
        $request->validate([
            'name' => 'required',
            'slug' => 'unique:blogcategories',
            'image' => 'nullable|mimetypes:image/jpg,image/jpeg|max:1024',
        ]);        

        $blogcategory = new Blogcategory();

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'blogcategories_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/blogcategories"), $file_name)){                
                $blogcategory->image = $file_name;
            }
        }
        $blogcategory->title = $request->name;
        $blogcategory->slug = $request->slug;
        if(isset($request->is_menu))
        {
            $blogcategory->is_menu = 1;
        }
        $blogcategory->save();

        $img = $blogcategory->image == null ? '' : "<img class='rounded' src='". asset('storage/blogcategories/'.$blogcategory->image)."' style='width: 50px'/>";

        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog category has been added successfully.",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogcategory  $blogcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Blogcategory $blogcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogcategory  $blogcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogcategory $blogcategory)
    {
        return view('admin.blogcategories.edit', ['blogcategory' => $blogcategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogcategory  $blogcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogcategory $blogcategory)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:blogcategories,slug,'.$blogcategory->id,
            'image' => 'nullable|mimetypes:image/jpg,image/jpeg|max:1024',
        ]);


        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'blogcategories'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/blogcategories"), $file_name)){   
                if(is_file(public_path('storage/blogcategories/'.$blogcategory->image))){
                    unlink(public_path('storage/blogcategories/'.$blogcategory->image));
                }             
                $blogcategory->image = $file_name;
            }
        }

        $blogcategory->title = $request->name;
        $blogcategory->slug = $request->slug;
        if(isset($request->is_menu))
        {
            $blogcategory->is_menu = 1;
        }
        else
        {
            $blogcategory->is_menu = 0;
        }
        $blogcategory->save();
        $img = $blogcategory->image == null ? '' : "<img class='rounded' src='". asset('storage/blogcategories/'.$blogcategory->image)."' style='width: 50px'/>";
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog category has been updated successfully.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogcategory  $blogcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogcategory $blogcategory)
    {
        if($blogcategory->blog()->exists())
        {
            return back()->with('success', 'Error.! Oops.! you cannont delete a used category. Kindly update or delete relational Blog of it.');
        }

        if(is_file(public_path('storage/blogcategories/'.$blogcategory->image))){
            unlink(public_path('storage/blogcategories/'.$blogcategory->image));
        }

        $blogcategory->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog category has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.blogcategories.table', [
            'categories' => Blogcategory::latest()->get()
        ]);
    }
}
