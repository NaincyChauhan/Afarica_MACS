<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-category', ['only' => ['index','show']]);
        $this->middleware('permission:create-category', ['only' => ['create','store']]);
        $this->middleware('permission:update-category', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-category', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', [
            'active' => 'category',
            'categories' => Category::latest()->get()
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
        //creating slug
        if(!isset($request->slug))
        {
            $request->slug = (string) Str::of($request->name)->slug('-');
        }
        $request->validate([
            'name' => 'required',
            'slug' => 'unique:categories',
            'image' => 'nullable|mimetypes:image/jpg,image/jpeg|max:1024|min:2',
        ]);        

        $category = new Category();

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
        $category->slug = $request->slug;
        if(isset($request->is_menu))
        {
            $category->is_menu = 1;
        }
        $category->save();

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
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id,
            'image' => 'nullable|mimetypes:image/jpg,image/jpeg|max:1024|min:2',
        ]);


        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'categories'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/categories"), $file_name)){   
                if(is_file(public_path('storage/categories/'.$category->image))){
                    unlink(public_path('storage/categories/'.$category->image));
                }             
                $category->image = $file_name;
            }
        }

        $category->title = $request->name;
        $category->slug = $request->slug;
        if(isset($request->is_menu))
        {
            $category->is_menu = 1;
        }
        else
        {
            $category->is_menu = 0;
        }
        $category->save();
        $img = $category->image == null ? '' : "<img class='rounded' src='". asset('storage/categories/'.$category->image)."' style='width: 50px'/>";
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog category has been updated successfully.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // if($category->listing()->exists())
        // {
        //     return back()->with('success', 'Error.! Oops.! you can not delete a used category. Kindly update or delete relational Listing of it.');
        // }        

        if(is_file(public_path('storage/categories/'.$category->image))){
            unlink(public_path('storage/categories/'.$category->image));
        }

        $category->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog category has been deleted successfully.",
        ], 200);
    }

    public function subcategory($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.categories.subcategories', ['subcategories' => $category->subcategory]);
    }

    public function subcategoryByCategoryId(Request $request)
    {
        $data = '<option value="" selected>Select Subcategory</option>';
        foreach(Subcategory::where('category_id', $request->id)->get() as $subcategory)
        {
            $data .= '<option value="'.$subcategory->id.'">'.$subcategory->title.'</option>';
        }

        return response()->json(['status' => 1, 'msg' => 'Successfully', 'data' => $data], 200);
    }

    public function loadTable()
    {
        return view('admin.categories.table', [
            'categories' => Category::latest()->get()
        ]);
    }

}
