<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Models\Listingextension;
use App\Models\Subextension;
use App\Models\Extension;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ListingController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-listing', ['only' => ['index','show']]);
        $this->middleware('permission:create-listing', ['only' => ['create','store']]);
        $this->middleware('permission:update-listing', ['only' => ['edit','update','ChangeStatus']]);
        $this->middleware('permission:delete-listing', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.listings.index', [
            'active' => 'listing',
            'listings' => Listing::select('id','title','slug','sell_price','regular_price','address','image','status')
            ->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.listings.add', [
            'active' => 'listing',
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
            'description' => 'required',
            'map_location' => 'required',
            'slug' => 'required|unique:listings',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'address' => 'required',
            'content' => 'required',
            'keyword' => 'required',
            'image' => 'required',
        ]);
        
        $listing = new Listing();
        // upload Images
        if($request->hasfile('image')){            
            $imagearray = [];
            foreach ($request->file('image') as $key => $file) {
                $file_name = '';
                $file_name = 'listings_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
                if(!$file->move(public_path("storage/listings"), $file_name)){   
                    return back()->with('error', 'Error! Image can not be upload. Please try again.');
                }
                array_push($imagearray,$file_name);
            }
            $listing->image = $imagearray;
        }
        $listing->title = $request->title;
        $listing->sell_price = $request->sell_price;
        $listing->regular_price = $request->regular_price;
        $listing->slug = $request->slug;
        $listing->map_location = $request->map_location;
        $listing->description = $request->description;
        $listing->city = $request->city;
        $listing->state = $request->state;
        $listing->country = $request->country;
        $listing->address = $request->address;
        $listing->keyword = $request->keyword;
        $listing->content = $request->content;
        $listing->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Listing has been added successfully.",            
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return view('admin.listings.edit', [
            'active' => 'listing',
            'listing' => $listing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        //creating slug
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'map_location' => 'required',
            'slug' => 'required|unique:listings,slug,'.$listing->id,
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'address' => 'required',
            'content' => 'required',
            'keyword' => 'required',
        ]);

        if($request->hasfile('image')){
            $imagearray = [];
            foreach($request->file('image') as $key => $file)
            {
                $file_name = '';
                $file_name = 'listings_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
                if($file->move(public_path("storage/listings"), $file_name)){
                    if($listing->image != ''){   
                        foreach ($listing->image as $key => $value) {                                             
                            if(is_file(public_path('storage/listings/'.$value)))
                            {
                                unlink(public_path('storage/listings/'.$value));
                            }
                        }                 
                    }
                }
                array_push($imagearray,$file_name);
            }
            $listing->image = $imagearray;
        }

        $listing->title = $request->title;
        $listing->sell_price = $request->sell_price;
        $listing->regular_price = $request->regular_price;
        $listing->slug = $request->slug;
        $listing->map_location = $request->map_location;
        $listing->description = $request->description;
        $listing->city = $request->city;
        $listing->state = $request->state;
        $listing->country = $request->country;
        $listing->address = $request->address;
        $listing->keyword = $request->keyword;
        $listing->content = $request->content;
        $listing->save();
        $imagedata="";
        foreach ($listing->image as $key => $image) {
            $imagedata .= "<img class='rounded' src='". asset('storage/listings/'.$image)."' style='width: 100px'/>";
        }
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Listing has been Updated successfully.",                   
            'img' => $imagedata,            
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        if($listing->image != ''){
            foreach ($listing->image as $key => $image) {
                if(is_file(public_path('storage/listings/'.$image)))
                {
                    unlink(public_path('storage/listings/'.$image));
                }
            }
        }
        $listing->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! listing has been deleted successfully.",
        ], 200);
    }

    public function loadTable(){
        return view('admin.listings.table', [
            'listings' => Listing::select('id','title','slug','sell_price','regular_price','address','image','status')->latest()->get(),
        ]);
    }

    public function ChangeStatus($id)
    {
        $listing = Listing::where('id', $id)->first();
        if($listing)
        {
            if($listing->status == 1)
            {
                $listing->status = 0;
            }
            else
            {
                $listing->status = 1;
            }
            $listing->save();
            return response()->json([
                'status' => 1,
                'message' => 'Success.! Listing status has been changed.',
            ], 200);
        }

    }
}
