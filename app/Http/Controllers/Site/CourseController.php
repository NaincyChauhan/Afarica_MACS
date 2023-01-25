<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Coursereview;
use App\Models\Usercourse;
use App\Http\Controllers\Controller;
use Session, Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $course = $this->returnBack($request);
        return view('site.courses.index',[
            'active' => 'courses',
            'courses' => $course->where('status',1)->paginate(10),
        ]);
    }

    public function detail($slug){
        $course = Course::where('slug',$slug)->latest()->with('usercourse')->first();
        if(!$course->exists())
        {
            return abort(404);
        }
        return view('site.courses.detail',[
            'course' => $course,            
            'active' => $course->type == 0 ? 'it-consultancy' : 'health-consultancy',
            'submenu' => 'courses',
        ]);
    }

    public function courseContent($slug){
        // $course = Course::where('slug',$slug)->select('id', 'title', 'slug', 'description', 'created_at', 'regular_price', 'sell_price', 'content','status')->with('coursecontent')->latest()->first();
        
        $course = Course::where('slug',$slug)->select('id', 'title', 'slug', 'description', 'created_at', 'regular_price', 'sell_price', 'content','status')->with('coursecontent','usercourse')->latest()->first();
        if(!$course->exists())
        {
            return abort(404);
        }
        if (($course->usercourse->where('user_id',Auth::user()->id)->first() && $course->usercourse->where('user_id',Auth::user()->id)->first()->payment_status == 'COMPLETED') || (empty($course->sell_price) && empty($course->regular_price))) {
            return view('site.courses.course-content',[
                'course' => $course,
                'active' => $course->type == 0 ? 'it-consultancy' : 'health-consultancy',
                'submenu' => 'courses',
            ]);
        }else{
            return abort(404);
        }
    }

    public function filter(Request $request){
        $course = Course::query();

        if (isset($request->show)) {
            Session::put('show',$request->show);
            $show = $request->show;
        }

        if(isset($request->type)){
            $course->where('type',$request->type);
        }

        if (isset($request->ratting)) {
            $course->where('ratting','>=',$request->ratting);
            Session::put('ratting',$request->ratting);
        }

        if(isset($request->short_type))
        {
            $type = $request->short_type;
            $course =  $this->checkSort($course,$type);  
            Session::put('short',$type);          
        }

        if (Session::has('search')) {
            $search = Session::get('search');
            $course->where(function($q) use ($search){
                $q->where('title', 'LIKE', '%'.$search.'%')
                ->orWhere('slug', 'LIKE', '%'.$search.'%')
                ->orWhere('description', 'LIKE', '%'.$search.'%')
                ->orWhere('keyword', 'LIKE', '%'.$search.'%');
            });
        }
        if(Session::has('show') && !isset($request->show)){
            $show = Session::get('show');
        }
        if(Session::has('ratting') && !isset($request->ratting)){
            $course->where('ratting','>=',Session::get('ratting'));
        }
        if(Session::has('short') && !isset($request->short)){
            $type = Session::get('short');
            $course =  $this->checkSort($course,$type);  
        }

        $course->select('id', 'title', 'slug', 'description', 'created_at', 'regular_price', 'sell_price', 'thumbnail','ratting','status');
        return view('site.courses.ajax-listing',[
            'active' => 'courses',
            'type' => $request->type,
            'courses' => $course->where('status',1)->paginate(isset($show) ? $show : 10),
        ]);
    }

    public function checkSort($courses,$type){
        if($type == "alphabetically_a_z")
        {
            $courses->orderBy('title', 'ASC');
        }

        if($type == "alphabetically_z_a")
        {
            $courses->orderBy('title', 'DESC');
        }

        if($type == "date_new_to_old")
        {
            $courses->orderBy('created_at', 'ASC');
        }
        if($type == "date_old_to_new")
        {
            $courses->orderBy('created_at', 'DESC');
        }
        if($type == "popular")
        {
            $courses->where('is_popular', 1);
        }

        return $courses;
    }

    public function healthConsultancy(Request $request){
        $course = $this->returnBack($request);
        return view('site.courses.index',[
            'active' => 'health-consultancy',
            'submenu' => 'course',
            'courses' => $course->where('type',1)->where('status',1)->with('coursereview')->paginate(10),
            'type' => 1
        ]);
    }

    public function itConsultancy(Request $request){
        $course = $this->returnBack($request);
        return view('site.courses.index',[
            'active' => 'it-consultancy',
            'submenu' => 'course',
            'courses' => $course->where('type',0)->where('status',1)->with('coursereview')->paginate(10),
            'type' => 0
        ]);
    }

    public function returnBack($request){
        Session::forget('short');
        Session::forget('show');
        Session::forget('ratting');
        Session::forget('search');
        $course = Course::select('id', 'title', 'slug', 'description', 'created_at', 'regular_price', 'sell_price', 'thumbnail','ratting','status');

        if (isset($request->search))
        {
            $course->where(function($q) use ($request){
                $q->where('title', 'LIKE', '%'.$request->search.'%')
                ->orWhere('slug', 'LIKE', '%'.$request->search.'%')
                ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                ->orWhere('keyword', 'LIKE', '%'.$request->search.'%');
            });
            Session::put('search',$request->search);
        }
        return $course;
    }

    public function buyCourse(Request $request){
        if (isset($request->transaction_status) && isset($request->transaction_id)) {
            $usercourse = new Usercourse();
            $usercourse->user_id = Auth::user()->id;
            $usercourse->course_id = $request->course_id;
            $usercourse->payment_status = $request->transaction_status;
            $usercourse->transaction_id = $request->transaction_id;
            $usercourse->total_amount = $request->total_price;
            $usercourse->save();
        }
        return redirect(route('user-course'));
    }

    public function courseReview($course_id){
        return view('site.courses.ajax-course-review',[
            'coursereviews' => Coursereview::where('course_id',$course_id)->with('user')->paginate(10),
        ]);
    }
}
