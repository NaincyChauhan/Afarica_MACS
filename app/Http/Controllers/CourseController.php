<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-course', ['only' => ['index','show']]);
        $this->middleware('permission:create-course', ['only' => ['create','store']]);
        $this->middleware('permission:update-course', ['only' => ['edit','update','courseChangeStatus']]);
        $this->middleware('permission:delete-course', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->type) && ($request->type == 0 || $request->type == 1)) {
            $course = Course::where('type',$request->type)->latest()->select('title', 'status', 'keyword' ,'id','regular_price','sell_price','duration','thumbnail')->get();
            return view('admin.courses.index',[
                'active' => 'course',
                'courses' => $course,
                'type' => $request->type,
            ]);
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(isset($request->type) && ($request->type == 0 || $request->type == 1)){
            return view('admin.courses.add', [
                'active' => 'course',
                'type' => $request->type,
            ]);
        }else{
            return abort(404);
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
            'slug' => 'required|unique:courses',
            'description' => 'required',
            'keyword' => 'required',
            'content' => 'required',
            'duration' => 'required',
            'preview' => 'required',
            'thumbnail' => 'required|mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('thumbnail'))
        {
            $file_name = '';
            $file = $request->file('thumbnail');
            $file_name = 'course_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if(!$file->move(public_path("storage/courses"), $file_name)){   
                return back()->with('error', 'Error! Image can not be upload. Please try again.');
            }
        }

        $course = new Course();
        $course->title = $request->title;
        $course->slug = $request->slug;
        $course->description = $request->description;
        $course->keyword = $request->keyword;
        $course->thumbnail = $file_name;
        $course->content = $request->content;
        $course->sell_price = $request->sell_price;
        $course->regular_price = $request->regular_price;
        $course->preview = $request->preview;
        $course->duration = $request->duration;
        $course->type = $request->type;
        $course->save();

        return response()->json([
            'status' => 1, 
            'message' => "Success.! Course has been added successfully.",            
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', [
            'active' => 'course',
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //creating slug
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses,slug,'.$course->id,
            'description' => 'required',
            'keyword' => 'required',
            'content' => 'required',
            'duration' => 'required',
            'preview' => 'required',
            'thumbnail' => 'nullable|mimetypes:image/jpg,image/png,image/jpeg,image/webp|max:1024|min:2',
        ]);

        //Uploading Image
        if($request->hasFIle('thumbnail'))
        {
            $file_name = '';
            $file = $request->file('thumbnail');
            $file_name = 'course_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/courses"), $file_name)){   
                if(is_file(public_path('storage/courses/'.$course->thumbnail))){
                    unlink(public_path('storage/courses/'.$course->thumbnail));
                }             
                $course->thumbnail = $file_name;
            }
        }

        $course->title = $request->title;
        $course->slug = $request->slug;
        $course->description = $request->description;
        $course->keyword = $request->keyword;
        $course->content = $request->content;
        $course->sell_price = $request->sell_price;
        $course->regular_price = $request->regular_price;
        $course->preview = $request->preview;
        $course->duration = $request->duration;
        $course->save();

        return response()->json([
            'status' => 1, 
            'message' => "Success.! Course has been updated successfully.",            
            'img' => $course->thumbnail == null ? '' : "<img class='rounded' src='". asset('storage/courses/'.$course->thumbnail)."' style='width: 50px'/>",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if(is_file(public_path('storage/courses/'.$course->thumbnail))){
            unlink(public_path('storage/courses/'.$course->thumbnail));
        }
        $course->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! course has been deleted successfully.",
        ], 200);
    }

    public function loadTable($type)
    {
        return view('admin.courses.table', [
            'courses' => Course::where('type',$type)->latest()->select('title','status', 'keyword' ,'id','regular_price','sell_price','duration','thumbnail')->get(),
            'type' => $type,
        ]);
    }

    public function courseChangeStatus($id)
    {
        $course = Course::where('id', $id)->first();
        if($course)
        {
            if($course->status == 1)
            {
                $course->status = 0;
            }
            else
            {
                $course->status = 1;
            }
            $course->save();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Success.! Course status has been changed.',
        ], 200);
    }

}
