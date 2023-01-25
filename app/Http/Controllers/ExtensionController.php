<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Subextension;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExtensionController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-extension', ['only' => ['index','show']]);
        $this->middleware('permission:create-extension', ['only' => ['create','store']]);
        $this->middleware('permission:update-extension', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-extension', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.extensions.index', [
            'active' => 'extension',
            'extensions' => Extension::select('id', 'title', 'slug')->latest()->get(),
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
            'slug' => 'unique:extensions',
        ]);

        $extension = new Extension();
        $extension->title = $request->name;
        $extension->slug = $request->slug;        
        $extension->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Extension has been added successfully.",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function show(Extension $extension)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function edit(Extension $extension)
    {
        return view('admin.extensions.edit', [
            'extension' => $extension,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Extension $extension)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:extensions,slug,'.$extension->id,
        ]);

        $extension->title = $request->name;
        $extension->slug = $request->slug;   
        $extension->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Extension has been updated successfully.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Extension  $extension
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extension $extension)
    {
        if($extension->listingextension()->exists())
        {
            return back()->with('success', 'Error.! Oops.! you cannont delete a used Listing. Kindly update or delete relational Listing of it.');
        }        
        $extension->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Extension has been deleted successfully.",
        ], 200);
    }

    public function subextensionByExtensionId(Request $request)
    {
        $data = '<option value="" selected>Select Extension</option>';
        foreach(Subextension::where('extension_id', $request->id)->get() as $subextension)
        {
            $data .= '<option value="'.$subextension->id.'">'.$subextension->title.'</option>';
        }

        return response()->json(['status' => 1, 'msg' => 'Successfully', 'data' => $data], 200);
    }

    public function loadTable()
    {
        return view('admin.extensions.table', [
            'extensions' => Extension::select('id', 'title', 'slug')->latest()->get(),
        ]);
    }
}
