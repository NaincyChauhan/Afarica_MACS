<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-subcategory', ['only' => ['index','show']]);
        $this->middleware('permission:create-subcategory', ['only' => ['create','store']]);
        $this->middleware('permission:update-subcategory', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-subcategory', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategories.index', [
            'active' => 'subcategory',
            'subcategories' => Subcategory::latest()->get(),
            'categories' => Category::latest()->get(),
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
        $category = Category::where('id', $request->category_id)->first();
        //creating slug
        if(!isset($request->slug))
        {
            $request->slug = (string) Str::of($category->title." ".$request->name)->slug('-');
        }
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'slug' => 'unique:subcategories',
            'image' => 'nullable|mimetypes:image/jpg,image/jpeg|max:1024|min:2',
        ]);        

        $category = new Subcategory();

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'categories_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/categories"), $file_name)){                
                $category->image = $file_name;
            }
        }
        $category->title = $request->name;
        $category->category_id = $request->category_id;
        $category->slug = $request->slug;        
        $category->save();

        $img = $category->image == null ? '' : "<img class='rounded' src='". asset('storage/categories/'.$category->image)."' style='width: 50px'/>";

        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog category has been added successfully.",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategories.edit', ['category' => $subcategory,'categories' => Category::latest()->get(),]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'slug' => 'required|unique:subcategories,slug,'.$subcategory->id,
            'image' => 'nullable|mimetypes:image/jpg,image/jpeg|max:1024|min:2',
        ]);


        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'categories'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/categories"), $file_name)){   
                if(is_file(public_path('storage/categories/'.$subcategory->image))){
                    unlink(public_path('storage/categories/'.$subcategory->image));
                }             
                $subcategory->image = $file_name;
            }
        }

        $subcategory->category_id = $request->category_id;
        $subcategory->title = $request->name;
        $subcategory->slug = $request->slug;       
        $subcategory->save();
        $img = $subcategory->image == null ? '' : "<img class='rounded' src='". asset('storage/categories/'.$subcategory->image)."' style='width: 50px'/>";
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog subcategory has been updated successfully.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        // if($subcategory->listing()->exists())
        // {
        //     return back()->with('success', 'Error.! Oops.! you cannont delete a used subcategory. Kindly update or delete relational Listing of it.');
        // }        

        if(is_file(public_path('storage/categories/'.$subcategory->image))){
            unlink(public_path('storage/categories/'.$subcategory->image));
        }

        $subcategory->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog Subcategory has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.subcategories.table', [
            'subcategories' => Subcategory::latest()->get(),
        ]);
    }
}
