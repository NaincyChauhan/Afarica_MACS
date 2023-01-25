<?php

namespace App\Http\Controllers;

use App\Models\Userapplication;
use App\Models\Transaction;
use App\Models\Listing;
use App\Models\Staff;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Exception, Auth, Carbon\Carbon, Mail;

class UserapplicationController extends Controller
{
    function __construct()
    {
        // // set permission
        // $this->middleware('permission:read-userapplication', ['only' => ['index','show']]);
        // $this->middleware('permission:create-userapplication', ['only' => ['create','store']]);
        // $this->middleware('permission:update-userapplication', ['only' => ['edit','update']]);
        // $this->middleware('permission:delete-userapplication', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.userapplications.index',[
            'active' => 'application',
            'applications' => Userapplication::with('user')->get(),
            'staffs' => Staff::get(),
        ]);
    }

    public function todayApplication()
    {
        return view('admin.userapplications.index',[
            'active' => 'application',
            'today' => true,
            'applications' => Userapplication::whereDate('created_at', date('Y-m-d'))->with('user')->get(),
            'staffs' => Staff::get(),
        ]);
    }

    public function todayProcessApplication()
    {
        return view('admin.userapplications.index',[
            'active' => 'application',
            'todayprocess' => true,
            'applications' => Userapplication::where('status',2)->whereDate('created_at', date('Y-m-d'))->with('user')->get(),
            'staffs' => Staff::get(),
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
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                $application = new Userapplication();
                $application->user_id = Auth::user()->id;
                $application->listing_id = $request->listing_id;
                $application->transaction_id = $input['razorpay_payment_id'];
                $application->application_id = $this->appID();
                $application->amount = $request->amount;
                $application->payment_status = 1;
                $application->save();

                return back()->with('success', 'Payment Successfully.');
                  
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userapplication  $userapplication
     * @return \Illuminate\Http\Response
     */
    public function show(Userapplication $userapplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Userapplication  $userapplication
     * @return \Illuminate\Http\Response
     */
    public function edit(Userapplication $userapplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Userapplication  $userapplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userapplication $userapplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userapplication  $userapplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userapplication $userapplication)
    {
        //
    }

    public function appID()
    {
        $prefix = "HHNS";
        $date = date('my');
        $id = $prefix.$date.mt_rand();

        return $id;
    }

    public function assignStaff(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'ids' => 'required',
        ]);

        Userapplication::whereIn('id',explode(",",$request->ids))->update(['staff_id' => $request->staff_id, 'assign_date' => Carbon::now(), 'status' => 2]);
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Staff has been assigned successfully.",
        ], 200);
    }

    public function applicationChangeStatus(Request $request,$id){
        $application = Userapplication::where('id', $id)->first();
        if($application)
        {
            $application->status = $request->status;
            $application->save();

            if($request->status == 3)
            {
                $this->sendProfileUpdationMail("Profile Updation Required.", $application->user->email, $application->user->name,'mail.status-email');
            }
        }

        return response()->json([
            'status' => 1,
            'message' => 'Success.! Application status has been changed.',
        ], 200);
    }

    public function sendProfileUpdationMail($sub, $to, $name, $template)
    {
        $data = array('name' => $name);

        Mail::send($template, $data, function($message) use($to, $name, $sub) {
            $message->to($to, $name);
            $message->subject($sub);
            $message->from('info@hhnsewak.in','HHNSewak');
            $message->replyTo('info@hhnsewak.in', 'HHNSewak');
        });
    }

    public function uploadApplication(Request $request,$id){
        $userapplication = Userapplication::where('id',$id)->first();
        if ($userapplication) {
            if($request->hasFIle('document'))
            {
                $file_name = '';
                $file = $request->file('document');
                $file_name = 'userapplication_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
                if($file->move(public_path("storage/documents"), $file_name)){   
                    if(is_file(public_path('storage/documents/'.$userapplication->image))){
                        unlink(public_path('storage/documents/'.$userapplication->image));
                    }             
                    $userapplication->document = $file_name;
                }
            }
            $userapplication->save();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Success.! Application Document  has been uploaded.',
        ], 200);
    }

    public function loadTable(Request $request){
        if (isset($request->today) || $request->today == 1) {
            $applications = Userapplication::whereDate('created_at', date('Y-m-d'))->with('user')->get();
        }elseif(isset($request->todayprocess) || $request->today == 1){
            $applications = Userapplication::where('status',2)->whereDate('created_at', date('Y-m-d'))->with('user')->get();
        }else{
            $applications = Userapplication::with('user')->get();
        }
        return view('admin.userapplications.table',[
            'applications' => $applications,
        ]);
    }

    public function userDataToExcel($id)
    {
        $application = Userapplication::where("id", $id)->with('user')->first();
        if($application)
        {
            return view('admin.userapplications.user-data',[
                'user' => $application->user,
            ]);
        }

        return abort(404);
    }

    public function paymentHistory(){
        return view('admin.userapplications.payment-history',[
            'active' => 'payment-status',
            'payments' => Userapplication::with('user')->select('transaction_id','created_at','user_id','application_id','payment_status')->get(),
        ]);
    }

    public function ajaxFilter(Request $request)
    {
        $userapplications = Userapplication::where(function($query) use($request)
        {
            if($request->name == 'assign')
            {
                $query->whereNotNull('assign_date');
            }

            if($request->name == 'notassign')
            {
                $query->whereNull('assign_date');
            }

            if($request->name == 'pending')
            {
                $query->where('status', 0);
            }

            if($request->name == 'success')
            {
                $query->where('status', 1);
            }

            if($request->name == 'processing')
            {
                $query->where('status', 2);
            }

            if($request->from_date != '')
            {
                $query->whereDate('created_at','>=', $request->from_date);
            }

            if($request->to_date != '')
            {
                $query->whereDate('created_at','<=', $request->to_date);
            }

        })->with('user')->get();
        
        return view('admin.userapplications.ajax-list', [
            'applications' => $userapplications
        ]);
    }    

    public function storeWallet($id)
    {
        $user = Auth::user();
        $listing = Listing::where('id', $id)->first();
        if(!$listing)
        {
            return abort(404);
        }

        // Calculate Total Amount
        $application_fee = 0;
        $is_complete = false;
        if($user->gender != '' && $user->caste !='')
        {
            $is_complete = true;
        }
        if($is_complete)
        {
            switch($user->caste)
            {
                case "SC/ST":
                    $application_fee  = $listing->sc_st_fee;
                    break;
                case "OBC":
                    $application_fee  = $listing->obc_fee;
                    break;
                case "GEN":
                    $application_fee  = $listing->gen_fee;
                    break;
            }

            if($listing->female != '' && $user->gender == 'Female')
            {
                $application_fee = $listing->female_fee;
            }
        }

        // check for Wallet
        $total_amt = $application_fee + $listing->application_fee;
        if($user->wallet < $total_amt)
        {
            return back()->with('error', 'You don not have enough balance in your wallet.');
        }

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $total_amt;
        $transaction->transaction_id = 'By Wallet';
        $transaction->description = "Amount debit from your account.";
        $transaction->type = 0;
        $transaction->status = 1;
        $transaction->save();

        $user->wallet -= $total_amt;
        $user->save();

        $application = new Userapplication();
        $application->user_id = Auth::user()->id;
        $application->listing_id = $id;
        $application->transaction_id = 'By Wallet';
        $application->application_id = $this->appID();
        $application->amount = $total_amt;
        $application->payment_status = 1;
        $application->save();

        return back()->with('success', 'We have recieved your request. Your application no is '.$application->application_id.'.'); 
    }
    
}
