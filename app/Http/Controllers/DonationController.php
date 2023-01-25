<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    function __construct()
    {
        // set permission
        // $this->middleware('permission:read-donation', ['only' => ['index','show']]);
        // $this->middleware('permission:delete-donation', ['only' => ['destroy','multiDelete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.donations.index', [
            'active' => 'donation',
            'donations' => Donation::latest()->get()
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
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Donation has been deleted successfully.!", 
        ], 200);
    }

    public function multiDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required',
        ]);
        Donation::whereIn('id',explode(",",$request->ids))->delete();
        
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Donations has been deleted successfully.",
        ], 200);
    }

    public function loadTable()
    {
        return view('admin.donations.table', [
            'donations' => Donation::latest()->get()
        ]);
    }
}
