<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usercourse;
use App\Http\Controllers\Controller;
use Session, Auth;

class UserController extends Controller
{
    public function userCourseHealth()
    {
        $usercourses = $this->ReturnUserCourse(1);
        return view('site.user.course',[
            'usercourses' => $usercourses,
            'active' => 'health-consultancy',
        ]);
    }

    public function userCourseIt()
    {
        $usercourses = $this->ReturnUserCourse(0);
        return view('site.user.course',[
            'usercourses' => $usercourses,
            'active' => 'it-consultancy',
        ]);
    }

    public function ReturnUserCourse($type){
        $usercourses = Usercourse::where('user_id',Auth::user()->id)->where('payment_status','Completed')
                    ->whereHas('course',function($q) use ($type){
                        $q->where('type',  $type);})
                    ->paginate(10);
        return $usercourses;
    }

    public function changePassword(Request $request){
        return view('site.user.change-password',[
            'active' => $request->active,
        ]);
    }

    public function editProfile(Request $request){
        return view('site.user.update-profile',[
            'user' => User::where('id',Auth::user()->id)->select('name','email','address','image','mobile')->first(),
            'active' => $request->active,
        ]);
    }

    public function updateProfile(Request $request){
        $user = User::where('id',Auth::user()->id)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'mobile' => 'required',
            'address' => 'required',
        ]);

        //Uploading Image
        if($request->hasFIle('image'))
        {
            $file_name = '';
            $file = $request->file('image');
            $file_name = 'user_'.rand(00000, 99999).'.'. $file-> getClientOriginalExtension();
            if($file->move(public_path("storage/users"), $file_name)){   
                if(is_file(public_path('storage/users/'.$user->image))){
                    unlink(public_path('storage/users/'.$user->image));
                }             
            }
            $user->image = $file_name;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->save();

        return response()->json([
            'status' => 1, 
            'message' => "Success.! Profile has been updated successfully.",  
            'img' => $user->image != null ? '<img src="'.asset('storage/users/'.$user->image) .'" class="img-thumbnail rounded-circle user-profile-image"  alt="User Profile">' : '',  
            'profileimage' => $user->image != null ? '<img class="rounded-circle" src="'.asset('storage/users/'.$user->image).'" alt="user" width="50px">' : '',        
        ], 200);
    }
}
