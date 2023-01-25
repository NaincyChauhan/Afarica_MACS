<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Imagegallery;
use App\Models\Videogallery;
use App\Models\Eventbanner;
use App\Models\Eventenquiry;
use App\Models\Event;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Mail\UserMail;
use Mail;

class EventController extends Controller
{
    public function index(){
        return view('site.events.index',[
            'active' => 'event-home',
            'banners' => Eventbanner::get(),
            'events' => Event::select('slug','title','image')->latest()->take(6)->get(),
            'images' => Imagegallery::select('image')->latest()->take(6)->get(),
            'videos' => Videogallery::select('video','thumbnail','title','desc')->latest()->take(6)->get(),
        ]);
    }

    public function imagegallery(){
        return view('site.events.images',[
            'active' => 'event-images',
            'images' => Imagegallery::select('image')->latest()->paginate(12),
        ]);
    }

    public function videogallery(){
        return view('site.events.videos',[
            'active' => 'event-videos',
            'videos' => Videogallery::select('video','thumbnail','title','desc')->latest()->paginate(12),
        ]);
    }

    public function events(){
        return view('site.events.events',[
            'active' => 'event-events',
            'events' => Event::select('slug','title','image')->latest()->paginate(12),
        ]);
    }

    public function eventDetail($slug){
        $event = Event::where('slug',$slug)->latest()->first();        
        if(!$event->exists())
        {
            return abort(404);
        }
        return view('site.events.event-detail',[
            'event' => $event,
        ]);
    }

    public function contact(){
        return view('site.events.contact',[
            'active' => 'event-contact',
        ]);
    }

    public function sendMessage(Request $request){
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'message' => 'required',
        ]);

        $message = new Eventenquiry();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->mobile = $request->mobile;
        $message->message = $request->message;
        $message->save();
        $email = Setting::select('email')->first()->email;
        if ( $email != null && $email != "") {
            $data = [
                'subject' => "New Enquiry For Event and Decor Planning.",
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
}
