<?php

namespace App\Http\Controllers;

use App\Models\Subextension;
use App\Models\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubextensionController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-subextension', ['only' => ['index','show']]);
        $this->middleware('permission:create-subextension', ['only' => ['create','store']]);
        $this->middleware('permission:update-subextension', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-subextension', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subextensions.index', [
            'active' => 'subextension',
            'subextensions' => Subextension::latest()->get(),
            'extensions' => Extension::select('id', 'title')->get()
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
            'extension_id' => 'required',
            'name' => 'required',
            'slug' => 'unique:subextensions',
        ]);

        $subextension = new Subextension();
        $subextension->extension_id = $request->extension_id;
        $subextension->title = $request->name;
        $subextension->slug = $request->slug;         
        $subextension->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Sub Extension has been added successfully.",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subextension  $subextension
     * @return \Illuminate\Http\Response
     */
    public function show(Subextension $subextension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subextension  $subextension
     * @return \Illuminate\Http\Response
     */
    public function edit(Subextension $subextension)
    {
        return view('admin.subextensions.edit', [
            'subextension' => $subextension, 
            'extensions' => Extension::select('id', 'title')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subextension  $subextension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subextension $subextension)
    {
        $request->validate([
            'name' => 'required',
            'extension_id' => 'required',
            'slug' => 'required|unique:subextensions,slug,'.$subextension->id,
        ]);

        $subextension->extension_id = $request->extension_id;
        $subextension->title = $request->name;
        $subextension->slug = $request->slug;   
        $subextension->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Sub Extension has been updated successfully.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subextension  $subextension
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subextension $subextension)
    {
        if($subextension->listingextension()->exists())
        {
            return back()->with('success', 'Error.! Oops.! you cannont delete a used Listing. Kindly update or delete relational Listing of it.');
        }        
        $subextension->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! sub extension has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.subextensions.table', [
            'subextensions' => Subextension::latest()->with('extension')->get(),
        ]);
    }
}
