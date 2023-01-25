<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

use Razorpay\Api\Api;
use Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                $transaction = new Transaction();
                $transaction->user_id = Auth::user()->id;
                $transaction->amount = $request->amount;
                $transaction->transaction_id = $input['razorpay_payment_id'];
                $transaction->description = "Amount credit to your account.";
                $transaction->type = 1;
                $transaction->status = 1;
                $transaction->save();

                $user = Auth::user();
                $user->wallet += $request->amount;
                $user->save();

                return redirect()->route('my-wallet')->with('success', 'Payment Successfully.');
                  
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function myWallet()
    {
        return view('site.users.my-wallet',[
            'active' => 'my-wallet',
            'transactions' => Transaction::where('user_id', Auth::user()->id)->latest()->get(),
            'user' => Auth::user(),
        ]);
    }

    public function payNow(Request $request)
    {
        return view('site.users.pay-now',[
            'active' => 'my-wallet',
            'request' => $request,
            'user' => Auth::user(),
        ]);
    }
}
