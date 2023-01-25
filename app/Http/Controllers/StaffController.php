<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

use Hash;

class StaffController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-staff', ['only' => ['index','show']]);
        $this->middleware('permission:create-staff', ['only' => ['create','store']]);
        $this->middleware('permission:update-staff', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-staff', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.staffs.index', [
            'active' => 'user',
            'staffs' => Staff::with('user')->latest()->get(),
            'roles' => Role::where('slug', '!=', 'superadmin')
            ->where('slug', '!=', 'user')
            ->latest()->get(),
        ]);
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'mobile' => 'required',
            'role_id' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->mobile = $request->mobile;
        $user->username = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $staff = new Staff();
        $staff->user_id = $user->id;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->mobile = $request->mobile;
        $staff->save();

        $role = Role::where('id', $request->role_id)->first();
        $user->roles()->attach($role);
		$user->permissions()->attach($role->permissions);

        return response()->json([
            'status' => 1, 
            'message' => "Success.! Staff has been added successfully.",            
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        return view('admin.staffs.edit', [
            'staff' => $staff,
            'roles' => Role::where('slug', '!=', 'superadmin')
            ->where('slug', '!=', 'user')
            ->latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$staff->user_id,
            'mobile' => 'required',
            'role_id' => 'required',
            'password' => 'nullable|min:8',
        ]);
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->mobile = $request->mobile;
        $staff->save();

        $user = $staff->user;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->email;
        if(isset($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->userseroles()->delete();
        $role = Role::where('id', $request->role_id)->first();
        $user->roles()->attach($role);

        $user->usersepermissions()->delete();
		$user->permissions()->attach($role->permissions);

        return response()->json([
            'status' => 1, 
            'message' => "Success.! User has been updated successfully.",            
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->user()->delete();
        return response()->json([
            'status' => 1, 
            'message' => "Success.! User has been deleted successfully.",            
        ], 200);
    }    

    public function staffLoadTable()
    {
        return view('admin.staffs.table', [
            'active' => 'user',
            'staffs' => Staff::with('user')->latest()->get(),
        ]);
    }
}
