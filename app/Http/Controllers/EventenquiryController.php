<?php

namespace App\Http\Controllers;

use App\Models\Eventenquiry;
use Illuminate\Http\Request;

class EventenquiryController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-event-enquiry', ['only' => ['index','show']]);
        $this->middleware('permission:create-event-enquiry', ['only' => ['create','store']]);
        $this->middleware('permission:update-event-enquiry', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-event-enquiry', ['only' => ['destroy','multiDelete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.events.enquiry', [
            'active' => 'enquiry',
            'messages' => Eventenquiry::orderBy('id', 'DESC')->get()
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
     * @param  \App\Models\Eventenquiry  $eventenquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Eventenquiry $eventenquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eventenquiry  $eventenquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Eventenquiry $eventenquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eventenquiry  $eventenquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eventenquiry $eventenquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eventenquiry  $eventenquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eventenquiry $eventenquiry)
    {
        $eventenquiry->delete();
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
        Eventenquiry::whereIn('id',explode(",",$request->ids))->delete();
        
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Enquiry has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.events.enquiry-table', [
            'messages' => Eventenquiry::orderBy('id', 'DESC')->get()
        ]);
    }
}
