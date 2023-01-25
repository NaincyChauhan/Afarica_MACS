<?php

namespace App\Http\Controllers;

use App\Models\Consult;
use Illuminate\Http\Request;
use App\Mail\UserMail;
use App\Models\Setting;

use Mail;

class ConsultController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-consult', ['only' => ['index','show','healthConsultancy','itConsultancy']]);
        $this->middleware('permission:create-consult', ['only' => ['create']]);
        $this->middleware('permission:update-consult', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-consult', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.consult.index',[
            'active' => 'consult',
            'consults' => Consult::latest()->get(),
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
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'description' => 'required',
        ]);

        if (isset($request->transaction_status) && isset($request->transaction_id)) {
            $consult = new Consult();
            $consult->name = $request->name;
            $consult->email = $request->email;
            $consult->mobile = $request->mobile;
            $consult->type = $request->type;
            $consult->description = $request->description;
            $consult->short_desc = $request->short_desc;
            $consult->business_address = $request->business_address;
            $consult->company_name = $request->company_name;
            $consult->designation = $request->company_designation;
            $consult->company_type = $request->company_type;
            $consult->transaction_id = $request->transaction_id;
            $consult->payment_status = $request->transaction_status;
            $consult->save();
            $email = Setting::select('email')->first()->email;
            if ( $email != null && $email != "") {
                $data = [
                    'subject' => "New Request Form For ".($request->type==0?"It":"Health")." Consultancy",
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'user_message' => $request->description,
                    'template' => 'mail.message-2',
                ];
                Mail::to($email)->send(new UserMail($data));
            }
            return response()->json([
                'status' => 1, 
                'message' => 'Your Form has been sent successfull and your payment is '.$request->transaction_status.'. We will ping you soon!'
            ],200);
        }else{
            return response()->json([
                'status' => 0, 
                'message' => 'Sorry Your Request Not Send Successfully. Please Try Again!',
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function show(Consult $consult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function edit(Consult $consult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consult $consult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consult  $consult
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consult $consult)
    {
        $consult->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Consult Request has been deleted successfully.",
        ], 200);
    }

    public function loadTable($type){        
        return view('admin.consult.table',[
            'consults' => Consult::where('type',$type)->latest()->get(),
            'type' => $type,
        ]);
    }

    public function itConsultancy(){
        return view('admin.consult.index',[
            'active' => 'consult',
            'consults' => Consult::latest()->where('type',0)->get(),
            'type' => 0,
        ]);
    }

    public function healthConsultancy(){
        return view('admin.consult.index',[
            'active' => 'consult',
            'consults' => Consult::latest()->where('type',1)->get(),
            'type' => 1,
        ]);
    }
}
