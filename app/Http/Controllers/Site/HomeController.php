<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobapplication;
use App\Models\Listing;
use App\Models\Messages;
use App\Models\Policies;
use App\Models\Setting;
use App\Models\Consult;
use App\Models\Course;
use App\Models\Donation;
use App\Models\Coursereview;
use App\Mail\UserMail;

use Mail,Auth,Session;

class HomeController extends Controller
{
    public function index()
    {
        Session::forget('short');
        Session::forget('show');
        return view('site.home',[
            'active' => 'home',
            'setting' => Setting::select('mobile', 'whatsapp')->first(),
        ]);
    }

    public function webServices(){
        return view('site.markting.index');
    }

    public function about()
    {
        return view('site.about',[
            'active' => 'about',
        ]);
    }

    public function terms()
    {
        return view('site.terms',[
            'active' => 'about',
            'terms' => Policies::select('term')->first()->term
        ]);
    }

    public function policy()
    {
        return view('site.policy',[
            'active' => 'about',            
            'policy' => Policies::select('policy')->first()->policy
        ]);
    }

    public function contact()
    {
        return view('site.contact',[
            'active' => 'contact',
        ]);
    }

    public function sednMessage(Request $request){
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'mobile' => 'required',
        ]);

        $message = new Messages();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->mobile = $request->mobile;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $email = Setting::select('email')->first()->email;
        if ( $email != null && $email != "") {
            $data = [
                'subject' => $request->subject,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'user_message' => $request->message,
                'template' => 'mail.message',
            ];

            Mail::to($email)->send(new UserMail($data));
        }

        return response()->json([
            'status' => 1, 
            'message' => 'Your Message has been sent successfull. We will ping you soon!'
        ],200);
    }
    
    public function sendmail($data, $template)
    {
        Mail::send($template, $data, function($message) use($data) {
            $message->to('info@idigitalgroups.com', 'Idigitalgroups');
            $message->subject('New Inquiry - '.$data['subject']);
            $message->from('no-reply@idigitalgroups.com','Idigitalgroups');
            $message->replyTo('info@idigitalgroups.com', 'Idigitalgroups');
        });
    }

    public function faqs(){
        return view('site.faq',[
            'categories' =>  Category::latest()->get(),
        ]);
    }

    public function services(){
        return view('site.services',[
            'active' => 'Services',
        ]);
    }

    public function applyNow(){
        return view('site.consultancy-apply',[
            'active'=>'apply-now',
        ]);
    }

    public function storeApplication(Request $request){
        $request->validate([
            'name' =>  "required",
            'email' =>  "required",
            'mobile' =>  "required",
            'resume' => 'required|mimetypes:image/jpg,image/png,image/jpeg,image/jpg,image/webp|max:1024|min:100',
            'expected_sallry' =>  "required",
            'total_experience' =>  "required",
            'current_sallry' =>  "required",
            'address' =>  "required",    
        ]);

        $application = new Jobapplication();
        $application->name = $request->name;
        $application->job_id = $request->job_id;
        $application->email = $request->email;
        $application->mobile = $request->mobile;
        $application->expected_sallry = $request->expected_sallry;
        $application->total_experience = $request->total_experience;
        $application->current_sallry = $request->current_sallry;
        $application->address = $request->address;

        //Uploading Resume
        if($request->hasFIle('resume'))
        {
            $file_name = '';
            $file = $request->file('resume');
            $file_name = 'resume_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if(!$file->move(public_path("storage/documents"), $file_name)){   
                return back()->with('error', 'Error! Resume can not be upload. Please try again.');
            }
        }
        $application->resume = $file_name;
        $application->save();

        return response()->json([
            'status' => 1, 
            'message' => 'Your Application has been sent successfull. We will ping you soon!'
        ],200);
    }

    public function itConsultancy(){
        return view('site.consultancy-apply',[
            'active'=>'it-consultancy',
            'submenu' => 'apply-now',
            'type' => 0,
        ]);
    }


    public function healthConsultancy(){
        return view('site.consultancy-apply',[
            'active'=>'health-consultancy',
            'submenu' => 'apply-now',
            'type' => 1,
        ]);
    }

    public function healthAbout(){
        return view('site.about.health-about',[
            'active'=>'health-consultancy',
            'type' => 1,
        ]);
    }

    public function foundationAbout(){
        return view('site.foundation.about');
    }

    public function ITAbout(){
        return view('site.about.it-about',[
            'active'=>'it-consultancy',
            'type' => 0,
        ]);
    }

    public function sendReview(Request $request){
        $request->validate([
            'review' => 'required',
            'message' => 'required',
        ]);

        $coursereview = new Coursereview();
        $coursereview->course_id = $request->course_id;
        $coursereview->user_id = Auth::user()->id;
        $coursereview->ratting = $request->review;
        $coursereview->description = $request->message;
        $coursereview->save();

        $course = Course::where('id',$request->course_id)->first();
        $course->ratting = Coursereview::where('course_id',$request->course_id)->select('ratting')->avg('ratting');
        $course->save();

        return back()->with('success',"Review Has Been Send Successfully");
    }

    public function foundation(){
        return view('site.foundation.index',[
            'active' => 'foundation',
        ]);
    }

    public function Senddonation(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'amount' => 'required',
        ]);

        if (isset($request->transaction_status) && isset($request->transaction_id)) {
            $donation = new Donation();
            $donation->first_name = $request->first_name;
            $donation->last_name = $request->last_name;
            $donation->address = $request->address;
            $donation->mobile = $request->mobile;
            $donation->email = $request->email;
            $donation->amount = $request->amount;
            $donation->transaction_status = $request->transaction_status;
            $donation->transaction_id = $request->transaction_id;
            $donation->save();
            $email = Setting::select('email')->first()->email;
            if ( $email != null && $email != "") {
                $data = [
                    'subject' => "Donation",
                    'name' => $request->first_name. " " . $request->last_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'user_message' => $request->first_name. " ".$request->last_name. "Donate Money",
                    'template' => 'mail.message-2',
                ];
                Mail::to($email)->send(new UserMail($data));
            }
            return response()->json([
                'status' => 1, 
                'message' => 'Thank you so much for Donation'
            ],200);
        }else{
            return response()->json([
                'status' => 0, 
                'message' => 'Sorry Your Donation Not Send Successfully. Please Try Again!',
            ],200);
        }
    }
}
