<?php

namespace App\Http\Controllers;

use App\Models\Listingenquiry;
use Illuminate\Http\Request;

class ListingenquiryController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-listing-enquiry', ['only' => ['index','show']]);
        $this->middleware('permission:create-listing-enquiry', ['only' => ['create','store']]);
        $this->middleware('permission:update-listing-enquiry', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-listing-enquiry', ['only' => ['destroy','multiDelete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.listings.enquiry', [
            'active' => 'enquiry',
            'messages' => Listingenquiry::orderBy('id', 'DESC')->with('listing')->get()
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
     * @param  \App\Models\Listingenquiry  $listingenquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Listingenquiry $listingenquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listingenquiry  $listingenquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Listingenquiry $listingenquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listingenquiry  $listingenquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listingenquiry $listingenquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listingenquiry  $listingenquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Listingenquiry::where('id',$id)->first();
        $message->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Enquiry has been deleted successfully.!", 
        ], 200);
    }

    public function multiDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required',
        ]);
        Listingenquiry::whereIn('id',explode(",",$request->ids))->delete();
        
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Enquiry has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.listings.enquiry-table', [
            'messages' => Listingenquiry::orderBy('id', 'DESC')->get()
        ]);
    }
}
