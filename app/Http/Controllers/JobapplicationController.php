<?php

namespace App\Http\Controllers;

use App\Models\Jobapplication;
use Illuminate\Http\Request;

class JobapplicationController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-job-application', ['only' => ['index','show']]);
        $this->middleware('permission:create-job-application', ['only' => ['create','store']]);
        $this->middleware('permission:update-job-application', ['only' => ['edit','update','applicationChangeStatus']]);
        $this->middleware('permission:delete-job-application', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Jobapplication.index',[
            'active' => 'jobapplication',
            'jobapplications' => Jobapplication::latest()->with('job')->get(),
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
     * @param  \App\Models\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function show(Jobapplication $jobapplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobapplication $jobapplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobapplication $jobapplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jobapplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobapplication $jobapplication)
    {
        if(is_file(public_path('storage/documents/'.$jobapplication->resume))){
            unlink(public_path('storage/documents/'.$jobapplication->resume));
        }
        $jobapplication->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Application has been deleted successfully.",
        ], 200);
    }

    public function applicationChangeStatus(Request $request,$id){
        $application = Jobapplication::where('id', $id)->first();
        if($application)
        {
            $application->status = $request->status;
            $application->save();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Success.! Application status has been changed.',
        ], 200);
    }

    public function loadTable(){        
        return view('admin.Jobapplication.table',[
            'jobapplications' =>  Jobapplication::latest()->with('job')->get(),
        ]);
    }

    public function ajaxFilter(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $jobapplications = Jobapplication::where(function($query) use($request){
            if($request->name != ""){
                $query->where('status',$request->name);
            }
            if($request->from_date != ''){
                $query->whereDate('created_at','>=', $request->from_date);
            }
            if($request->to_date != ''){
                $query->whereDate('created_at','<=', $request->to_date);
            }
        })->with('user')->get();
        
        return view('admin.Jopapplications.ajax-list', [
            'jobapplications' => $jobapplications
        ]);
    }
}
