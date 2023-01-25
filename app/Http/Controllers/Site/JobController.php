<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Controllers\Controller;
use Session, Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $job = $this->returnBack($request);
        return view('site.jobs.index',[
            'active' => 'jobs',
            'jobs' => $job->where('status',1)->paginate(10),
        ]);
    }

    public function detail($slug){
        $job = Job::where('slug',$slug)->latest()->first();
        if(!$job->exists())
        {
            return abort(404);
        }
        return view('site.jobs.detail',[
            'job' => $job,
            'active' => $job->type == 0 ? 'it-consultancy' : 'health-consultancy',
            'submenu' => 'jobs',
        ]);
    }

    public function filter(Request $request){
        $job = Job::query();

        if (isset($request->show)) {
            Session::put('show',$request->show);
            $show = $request->show;
        }

        if(isset($request->type)){
            $job->where('type',$request->type);
        }

        if (Session::has('search')) {
            $search = Session::get('search');
            $job->where(function($q) use ($search){
                $q->where('title', 'LIKE', '%'.$search.'%')
                ->orWhere('slug', 'LIKE', '%'.$search.'%')
                ->orWhere('description', 'LIKE', '%'.$search.'%')
                ->orWhere('keywords', 'LIKE', '%'.$search.'%')
                ->orWhere('location', 'LIKE', '%'.$search.'%')
                ->orWhere('company_name', 'LIKE', '%'.$search.'%');
            });
        }
        if(Session::has('show')){
            $show = Session::get('show');
        }
        if(isset($request->short_type))
        {
            $type = $request->short_type;
            $job =  $this->checkSort($job,$type);  
            Session::put('short',$type);          
        }

        if(Session::has('short')){
            $type = Session::get('short');
            $job =  $this->checkSort($job,$type);  
        }

        return view('site.jobs.ajax-listing',[
            'active' => 'jobs',
            'jobs' => $job->where('status',1)->paginate(isset($show) ? $show : 10),
        ]);
    }

    public function checkSort($jobs,$type){
        if($type == "alphabetically_a_z")
        {
            $jobs->orderBy('title', 'ASC');
        }

        if($type == "alphabetically_z_a")
        {
            $jobs->orderBy('title', 'DESC');
        }

        if($type == "date_new_to_old")
        {
            $jobs->orderBy('created_at', 'ASC');
        }
        if($type == "date_old_to_new")
        {
            $jobs->orderBy('created_at', 'DESC');
        }
        if($type == "popular")
        {
            $jobs->where('is_popular', 1);
        }

        return $jobs;
    }

    public function healthConsultancy(Request $request){
        $job = $this->returnBack($request);
        return view('site.jobs.index',[
            'active' => 'health-consultancy',
            'submenu' => 'jobs',
            'jobs' => $job->where('type',1)->where('status',1)->paginate(10),
            'type' => 1
        ]);
    }

    public function itConsultancy(Request $request){
        $job = $this->returnBack($request);
        return view('site.jobs.index',[
            'active' => 'it-consultancy',
            'submenu' => 'jobs',
            'jobs' => $job->where('type',0)->where('status',1)->paginate(10),
            'type' => 0
        ]);
    }

    public function returnBack($request){
        Session::forget('short');
        Session::forget('show');
        Session::forget('search');
        $job = Job::select('id', 'title', 'slug', 'company_name', 'created_at', 'image','status');

        if (isset($request->search))
        {
            $job->where(function($q) use ($request){
                $q->where('title', 'LIKE', '%'.$request->search.'%')
                ->orWhere('slug', 'LIKE', '%'.$request->search.'%')
                ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                ->orWhere('keywords', 'LIKE', '%'.$request->search.'%')
                ->orWhere('location', 'LIKE', '%'.$request->search.'%')
                ->orWhere('company_name', 'LIKE', '%'.$request->search.'%');
            });
            Session::put('search',$request->search);
        }
        return $job;
    }
}
