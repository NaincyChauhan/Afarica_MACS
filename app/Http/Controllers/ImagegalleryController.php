<?php

namespace App\Http\Controllers;

use App\Models\Imagegallery;
use Illuminate\Http\Request;

class ImagegalleryController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-image', ['only' => ['index','show']]);
        $this->middleware('permission:create-image', ['only' => ['create','store']]);
        $this->middleware('permission:update-image', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-image', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.imagegalleries.index', [
            'active' => 'image-gallery',
            'imagegalleries' => Imagegallery::latest()->get()
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
        $request->validate([
            'image' => 'required|mimetypes:image/jpg,image/png,image/jpeg|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'image-gallery'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if(!$file->move(public_path("storage/gallery"), $file_name)){
                return back()->with('error', 'OOPS.! Something went wrong.');
            }
        }

        //storing data
        $imagegallery = new Imagegallery();
        $imagegallery->title = $request->title;
        $imagegallery->desc = $request->desc;
        $imagegallery->image = $file_name;
        $imagegallery->save();
        return response()->json(['status' => 1, 'msg' => 'Image gallery has been added successfully.!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imagegallery  $imagegallery
     * @return \Illuminate\Http\Response
     */
    public function show(Imagegallery $imagegallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imagegallery  $imagegallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagegallery $imagegallery)
    {
        return view('admin.imagegalleries.edit', ['imagegallery' => $imagegallery]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imagegallery  $imagegallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imagegallery $imagegallery)
    {
        $request->validate([
            'image' => 'nullable|mimetypes:image/jpg,image/png,image/jpeg|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'image=gallery'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/gallery"), $file_name)){   
                if(is_file(public_path('storage/gallery/'.$imagegallery->image))){
                    unlink(public_path('storage/gallery/'.$imagegallery->image));
                }             
                $imagegallery->image = $file_name;
            }
        }

        //storing data
        $imagegallery->title = $request->title;
        $imagegallery->desc = $request->desc;
        $imagegallery->save();
        return response()->json(['status' => 1, 'msg' => 'Image gallery has been updated successfully.!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imagegallery  $imagegallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imagegallery $imagegallery)
    {
        if(is_file(public_path('storage/gallery/'.$imagegallery->image)))
        {
            unlink(public_path('storage/gallery/'.$imagegallery->image));
        }

        $imagegallery->delete();       
        return response()->json(['status' => 1, 'msg' => 'Image gallery has been deleted successfully.!'], 200);
    }

    public function loadTable()
    {
        return view('admin.imagegalleries.table', [
            'imagegalleries' => Imagegallery::latest()->get()
        ]);
    }
}
