<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Listingenquiry;
use App\Http\Controllers\Controller;
use Session, Auth, Mail;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listing = $this->returnBack($request);
        return view('site.listings.index',[
            'active' => 'real-estate',
            'submenu' => 'listing',
            'listings' => $listing->where('status',1)->paginate(10),
        ]);
    }

    public function detail($slug){
        $listing = Listing::where('slug',$slug)->latest()->first();
        if(!$listing->exists())
        {
            return abort(404);
        }
        return view('site.listings.detail',[
            'listing' => $listing,            
            'active' => 'real-estate',
            'submenu' => 'listings',
        ]);
    }


    public function filter(Request $request){
        $listing = Listing::query();

        if (isset($request->show)) {
            Session::put('show',$request->show);
            $show = $request->show;
        }

        if(isset($request->short_type))
        {
            $type = $request->short_type;
            $listing =  $this->checkSort($listing,$type);  
            Session::put('short',$type);          
        }
        
        if (Session::has('search')) {
            $search = Session::get('search');
            $listing->where(function($q) use ($search){
                $q->where('title', 'LIKE', '%'.$search.'%')
                ->orWhere('slug', 'LIKE', '%'.$search.'%')
                ->orWhere('description', 'LIKE', '%'.$search.'%')
                ->orWhere('keyword', 'LIKE', '%'.$search.'%');
            });
        }
        if (Session::has('city')) {
            $listing->where('city', 'LIKE', '%'.Session::get('city').'%');
        }
        if (Session::has('state')) {
            $listing->where('state', 'LIKE', '%'.Session::get('state').'%');
        }
        if (Session::has('country')) {
            $listing->where('country', 'LIKE', '%'.Session::get('country').'%');
        }
        if(Session::has('show') && !isset($request->show)){
            $show = Session::get('show');
        }

        if(Session::has('short') && !isset($request->short)){
            $type = Session::get('short');
            $listing =  $this->checkSort($listing,$type);  
        }

        $listing->select('id', 'title', 'slug', 'description', 'created_at', 'regular_price', 'sell_price', 'image','status');
        return view('site.listings.ajax-listing',[
            'active' => 'real-estate',
            'submenu' => 'listing',
            'listings' => $listing->where('status',1)->paginate(isset($show) ? $show : 10),
        ]);
    }

    public function checkSort($listings,$type){
        if($type == "alphabetically_a_z")
        {
            $listings->orderBy('title', 'ASC');
        }

        if($type == "alphabetically_z_a")
        {
            $listings->orderBy('title', 'DESC');
        }

        if($type == "date_new_to_old")
        {
            $listings->orderBy('created_at', 'ASC');
        }
        if($type == "date_old_to_new")
        {
            $listings->orderBy('created_at', 'DESC');
        }
        if($type == "popular")
        {
            $listings->where('is_popular', 1);
        }

        return $listings;
    }


    public function returnBack($request){
        Session::forget('short');
        Session::forget('show');
        Session::forget('search');
        Session::forget('city');
        Session::forget('state');
        Session::forget('country');
        $listing = Listing::select('id', 'title', 'slug', 'description', 'created_at', 'regular_price', 'sell_price', 'image','status');

        if (isset($request->search))
        {
            $listing->where(function($q) use ($request){
                $q->where('title', 'LIKE', '%'.$request->search.'%')
                ->orWhere('slug', 'LIKE', '%'.$request->search.'%')
                ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                ->orWhere('keyword', 'LIKE', '%'.$request->search.'%');
            });
            Session::put('search',$request->search);
        }
        if (isset($request->city)) {
            $listing->where('city', 'LIKE', '%'.$request->city.'%');
            Session::put('city',$request->city);
        }
        if (isset($request->state)) {
            $listing->where('state', 'LIKE', '%'.$request->state.'%');
            Session::put('state',$request->state);
        }
        if (isset($request->country)) {
            $listing->where('country', 'LIKE', '%'.$request->country.'%');
            Session::put('country',$request->country);
        }
        return $listing;
    }

    public function enquiryNow(Request $request){
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'message' => 'required',
        ]);

        $listingenquiry =  new Listingenquiry();
        $listingenquiry->email = $request->email;
        $listingenquiry->name = $request->name;
        $listingenquiry->mobile = $request->mobile;
        $listingenquiry->address = $request->address;
        $listingenquiry->listing_id = $request->listing_id;
        $listingenquiry->message = $request->message;
        $listingenquiry->save();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'subject' => "Listing Enquiry",
            'user_message' => $request->message,
        ];
        $this->sendmail($data,'mail.message');

        return response()->json([
            'status' => 1, 
            'message' => 'Your Enquiry has been sent successfull. We will ping you soon!'
        ],200);
    }

    public function sendmail($data, $template)
    {
        Mail::send($template, $data, function($message) use($data) {
            $message->to($data['email'], 'MACS');
            $message->subject('New Inquiry - '.$data['subject']);
            $message->from('no-reply@nicsdedu.com','MACS');
            $message->replyTo('nicsdedu@gmail.com', 'MACS');
        });
    }
}
