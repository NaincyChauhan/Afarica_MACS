<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-job', ['only' => ['index','show']]);
        $this->middleware('permission:create-job', ['only' => ['create','store']]);
        $this->middleware('permission:update-job', ['only' => ['edit','update','ChangeStatus']]);
        $this->middleware('permission:delete-job', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->type)){
            if ($request->type == 0 || $request->type == 1) {
                return view('admin.jobs.index', [
                    'active' => 'job',
                    'jobs' => Job::latest()->where('type',$request->type)->get(),
                    'type' => $request->type,
                ]);
            }else{
                return abort(404);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(isset($request->type)){
            if ($request->type == 0 || $request->type == 1) {
                return view('admin.jobs.add', [
                    'active' => 'job',
                    'type' => $request->type,
                ]);
            }else{
                return abort(404);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creating slug
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:jobs',
            'keywords' => 'required',
            'location' => 'required',
            'content' => 'required',
            'company_name' => 'required',
            'position' => 'required',
            'job_type' => 'required',
            'salary' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'no_of_vacancy' => 'required',
            'image' => 'required|mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'jobs_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if(!$file->move(public_path("storage/jobs"), $file_name)){   
                return back()->with('error', 'Error! Image can not be upload. Please try again.');
            }
        }

        $job = new Job();
        $job->title = $request->title;
        $job->slug = $request->slug;
        $job->location = $request->location;
        $job->keywords = $request->keywords;
        $job->image = $file_name;
        $job->description = $request->content;
        $job->company_name = $request->company_name;
        $job->position = $request->position;
        $job->job_type = $request->job_type;
        $job->experience = $request->experience;
        $job->qualification = $request->qualification;
        $job->no_of_vacancy = $request->no_of_vacancy;
        $job->salary = $request->salary;
        $job->type = $request->type;
        $job->save();

        return response()->json([
            'status' => 1, 
            'message' => "Success.! Job has been added successfully.",            
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', [
            'active' => 'job',
            'job' => $job,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:jobs,slug,'.$job->id,
            'keywords' => 'required',
            'location' => 'required',
            'content' => 'required',
            'company_name' => 'required',
            'position' => 'required',
            'job_type' => 'required',
            'salary' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'no_of_vacancy' => 'required',
            'image' => 'mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'jobs_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/jobs"), $file_name)){   
                if(is_file(public_path('storage/jobs/'.$job->image))){
                    unlink(public_path('storage/jobs/'.$job->image));
                }             
                $job->image = $file_name;
            }
        }

        $job->title = $request->title;
        $job->slug = $request->slug;
        $job->location = $request->location;
        $job->keywords = $request->keywords;
        $job->description = $request->content;
        $job->company_name = $request->company_name;
        $job->position = $request->position;
        $job->job_type = $request->job_type;
        $job->experience = $request->experience;
        $job->qualification = $request->qualification;
        $job->no_of_vacancy = $request->no_of_vacancy;
        $job->salary = $request->salary;
        $job->save();

        return response()->json([
            'status' => 1, 
            'message' => "Success.! Job has been Updated successfully.",                   
            'img' => $job->image == null ? '' : "<img class='rounded' src='". asset('storage/jobs/'.$job->image)."' style='width: 50px'/>",            
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        if(is_file(public_path('storage/jobs/'.$job->image))){
            unlink(public_path('storage/jobs/'.$job->image));
        }
        $job->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Job has been deleted successfully.",
        ], 200);
    }

    public function ChangeStatus($id)
    {
        $job = Job::where('id', $id)->first();
        if($job)
        {
            if($job->status == 1)
            {
                $job->status = 0;
            }
            else
            {
                $job->status = 1;
            }
            $job->save();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Success.! Job status has been changed.',
        ], 200);
    }

    public function loadTable($type){
        return view('admin.jobs.table', [
            'jobs' => Job::where('type',$type)->latest()->get(),
            'type' => $type,
        ]);
    }
}
