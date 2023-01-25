<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-event', ['only' => ['index','show']]);
        $this->middleware('permission:create-event', ['only' => ['create','store']]);
        $this->middleware('permission:update-event', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-event', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.events.index', [
            'active' => 'events',
            'events' => Event::select('id', 'title', 'image', 'desc')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.add', [
            'active' => 'events',
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
            'slug' => 'required|unique:events',
            'desc' => 'required',
            'content' => 'required',
            'image' => 'required',
            // 'image' => 'required|mimetypes:image/jpg,image/png,image/jpeg|max:1024|min:2',
        ]);

        $events = new Event();
        // upload Images
        if($request->hasfile('image')){            
            $imagearray = [];
            foreach ($request->file('image') as $key => $file) {
                $file_name = '';
                $file_name = 'events_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
                if(!$file->move(public_path("storage/events"), $file_name)){   
                    return back()->with('error', 'Error! Image can not be upload. Please try again.');
                }
                array_push($imagearray,$file_name);
            }
            $events->image = $imagearray;
        }
        $events->title = $request->title;
        $events->slug = $request->slug;
        $events->desc = $request->desc;
        $events->content = $request->content;
        $events->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Event has been added successfully.",            
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', [
            'active' => 'events',
            'events' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }
        
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:events,slug,'.$event->id,
            'desc' => 'required',
            'content' => 'required',
        ]);

        if($request->hasfile('image')){
            $imagearray = [];
            foreach($request->file('image') as $key => $file)
            {
                $file_name = '';
                $file_name = 'events_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
                if($file->move(public_path("storage/events"), $file_name)){
                    if($event->image != ''){   
                        foreach ($event->image as $key => $value) {                                             
                            if(is_file(public_path('storage/events/'.$value)))
                            {
                                unlink(public_path('storage/events/'.$value));
                            }
                        }                 
                    }
                }
                array_push($imagearray,$file_name);
            }
            $event->image = $imagearray;
        }

        $event->title = $request->title;
        $event->slug = $request->slug;
        $event->desc = $request->desc;
        $event->content = $request->content;
        $event->save();
        $imagedata="";
        foreach ($event->image as $key => $image) {
            $imagedata .= "<img class='rounded' src='". asset('storage/events/'.$image)."' style='width: 100px'/>";
        }
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Event has been updated successfully.",   
            'img' =>  $imagedata,   
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if($event->image != ''){
            foreach ($event->image as $key => $image) {
                if(is_file(public_path('storage/events/'.$image)))
                {
                    unlink(public_path('storage/events/'.$image));
                }
            }
        }
        $event->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Event has been deleted successfully.!",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.events.table', [
            'events' => Event::select('id', 'title', 'image', 'desc')->latest()->get(),
        ]);
    }
}
