<?php

namespace App\Http\Controllers;

use App\Models\Coursecontent;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoursecontentController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-course-content', ['only' => ['index','show']]);
        $this->middleware('permission:create-course-content', ['only' => ['create','store']]);
        $this->middleware('permission:update-course-content', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-course-content', ['only' => ['destroy']]);
    }
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
    public function create($id)
    {
        return view('admin.coursecontents.add', [
            'active' => 'course',
            'course_id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        // dd($request);
        //creating slug
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }
        $request->validate([
            'title' => 'required',
            'video' => 'required',
            'duration'    => 'required',
            'slug'    => 'required|unique:coursecontents',
        ]);
        $coursecontent = new Coursecontent();
        $coursecontent->title = $request->title;
        $coursecontent->video = $request->video;
        $coursecontent->duration = $request->duration;
        $coursecontent->slug = $request->slug;
        $coursecontent->course_id = $request->course_id;
        $coursecontent->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Course Content has been added successfully.",            
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coursecontent  $coursecontent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::where('id', $id)->with('coursecontent')->get()->first();
        return view('admin.coursecontents.index', [            
            'active' => 'course',
            'course_id' => $id,
            'course_type' => $course->type,
            'coursecontents' => $course->coursecontent,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coursecontent  $coursecontent
     * @return \Illuminate\Http\Response
     */
    public function edit(Coursecontent $coursecontent)
    {
        return view('admin.coursecontents.edit', [
            'coursecontent' => $coursecontent,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coursecontent  $coursecontent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coursecontent $coursecontent)
    {
        //creating slug
        if(!isset($request->slug))
        {
            $request['slug'] = (string) Str::of($request->title)->slug('-');
        }
        $request->validate([
            'title' => 'required',
            'video' => 'required',
            'duration'    => 'required',
            'slug'    => 'required|unique:coursecontents,slug,'.$coursecontent->id,
        ]);
        $coursecontent->title = $request->title;
        $coursecontent->video = $request->video;
        $coursecontent->duration = $request->duration;
        $coursecontent->slug = $request->slug;
        $coursecontent->save();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Course Content has been updated successfully.",            
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coursecontent  $coursecontent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coursecontent $coursecontent)
    {
        $coursecontent->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! Course Content has been Deleted successfully.",            
        ], 200);
    }

    public function loadTable($course_id)
    {
        $course = Course::where('id', $course_id)->with('coursecontent')->get()->first();
        return view('admin.coursecontents.table', [
            'coursecontents' => $course->coursecontent,
            'course_id' => $course_id,
        ]);
    }
}
