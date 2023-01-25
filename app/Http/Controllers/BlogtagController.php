<?php

namespace App\Http\Controllers;

use App\Models\Blogtag;
use Illuminate\Http\Request;
use DB;

class BlogtagController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:manage-blogtag');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogtags.index', [
            'active' => 'blogtag',
            'blogtags' => Blogtag::latest()->get()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogtag  $blogtag
     * @return \Illuminate\Http\Response
     */
    public function show(Blogtag $blogtag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogtag  $blogtag
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogtag $blogtag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogtag  $blogtag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogtag $blogtag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogtag  $blogtag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogtag $blogtag)
    {
        $id = $blogtag->id;
        $blogtag->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog tag has been deleted successfully.",
        ], 200);
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        // dd('this is ids',$ids);
        DB::table("blogtags")->whereIn('id',explode(",",$ids))->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! blog tags has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.blogtags.table', [
            'blogtags' => Blogtag::latest()->get()
        ]);
    }
}
