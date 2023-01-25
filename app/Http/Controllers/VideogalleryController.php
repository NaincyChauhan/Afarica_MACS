<?php

namespace App\Http\Controllers;

use App\Models\Videogallery;
use Illuminate\Http\Request;

class VideogalleryController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-video', ['only' => ['index','show']]);
        $this->middleware('permission:create-video', ['only' => ['create','store']]);
        $this->middleware('permission:update-video', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-video', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.videogalleries.index', [
            'active' => 'video-gallery',
            'videogalleries' => Videogallery::latest()->get()
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
            'video' => 'required',
            'thumbnail' => 'required|mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('thumbnail'))
        {
            $file_name = '';
            $file = $request->file('thumbnail');
            $file_name = 'videogallery_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if(!$file->move(public_path("storage/videogalleries"), $file_name)){   
                return back()->with('error', 'Error! Image can not be upload. Please try again.');
            }
        }

        //storing data
        $videogallery = new Videogallery();
        $videogallery->title = $request->title;
        $videogallery->thumbnail = $file_name;
        $videogallery->desc = $request->desc;
        $videogallery->video = $request->video;
        $videogallery->save();
        return response()->json(['status' => 1, 'msg' => 'Video  has been added successfully.!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Videogallery  $videogallery
     * @return \Illuminate\Http\Response
     */
    public function show(Videogallery $videogallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Videogallery  $videogallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Videogallery $videogallery)
    {
        return view('admin.videogalleries.edit', ['videogallery' => $videogallery]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Videogallery  $videogallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videogallery $videogallery)
    {
        $request->validate([
            'video' => 'required',
            'thumbnail' => 'nullable|mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('thumbnail'))
        {
            $file_name = '';
            $file = $request->file('thumbnail');
            $file_name = 'videogallery_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/videogalleries"), $file_name)){   
                if(is_file(public_path('storage/videogalleries/'.$videogalleries->thumbnail))){
                    unlink(public_path('storage/videogalleries/'.$videogalleries->thumbnail));
                }             
                $videogallery->thumbnail = $file_name;
            }
        }

        //storing data
        $videogallery->title = $request->title;
        $videogallery->desc = $request->desc;
        $videogallery->video = $request->video;
        $videogallery->save();
        
        return response()->json(['status' => 1, 'msg' => 'Video  has been updated successfully.!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Videogallery  $videogallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videogallery $videogallery)
    {
        $videogallery->delete();
        
        return response()->json(['status' => 1, 'msg' => 'Video has been deleted successfully.!'], 200);
    }

    public function loadTable()
    {
        return view('admin.videogalleries.table', [
            'videogalleries' => Videogallery::latest()->get()
        ]);
    }
}
