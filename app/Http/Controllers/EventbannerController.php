<?php

namespace App\Http\Controllers;

use App\Models\Eventbanner;
use Illuminate\Http\Request;

class EventbannerController extends Controller
{
    function __construct()
    {
        // set permission
        // $this->middleware('permission:read-event-banner', ['only' => ['index','show']]);
        // $this->middleware('permission:create-event-banner', ['only' => ['create','store']]);
        // $this->middleware('permission:update-event-banner', ['only' => ['edit','update']]);
        // $this->middleware('permission:delete-event-banner', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.event-banners.index', [
            'active' => 'event-banner',
            'eventbanners' => Eventbanner::latest()->get()
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
            'title' => 'required',
            'image' => 'required|mimetypes:image/jpg,image/jpeg|max:1024|min:2',
        ]);        

        $eventbanner = new Eventbanner();

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'banner_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/banners"), $file_name)){                
                $eventbanner->image = $file_name;
            }
        }
        $eventbanner->title = $request->title;
        $eventbanner->save();

        return response()->json([
            'status' => 1, 
            'message' => "Success.! Event Banner has been added successfully.",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eventbanner  $eventbanner
     * @return \Illuminate\Http\Response
     */
    public function show(Eventbanner $eventbanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eventbanner  $eventbanner
     * @return \Illuminate\Http\Response
     */
    public function edit(Eventbanner $eventbanner)
    {
        return view('admin.event-banners.edit', ['eventbanner' => $eventbanner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eventbanner  $eventbanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eventbanner $eventbanner)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimetypes:image/jpg,image/jpeg|max:1024|min:2',
        ]);


        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'banner'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/banners"), $file_name)){   
                if(is_file(public_path('storage/banners/'.$eventbanner->image))){
                    unlink(public_path('storage/banners/'.$eventbanner->image));
                }             
                $eventbanner->image = $file_name;
            }
        }

        $eventbanner->title = $request->title;
        $eventbanner->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Event Banner has been updated successfully.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eventbanner  $eventbanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eventbanner $eventbanner)
    {
        if(is_file(public_path('storage/banners/'.$eventbanner->image))){
            unlink(public_path('storage/banners/'.$eventbanner->image));
        }

        $eventbanner->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Event Banner has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.event-banners.table', [
            'eventbanners' => Eventbanner::latest()->get(),
        ]);
    }
}
