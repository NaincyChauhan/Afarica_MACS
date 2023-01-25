<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Roles_permissions;
use App\Models\Users_permissions;
use Illuminate\Support\Str;

use Auth;

class RoleController extends Controller
{
    function __construct()
    {
        // set permission
        $this->middleware('permission:read-role', ['only' => ['index','show']]);
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:update-role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }
    public function index()
    {
        // if(!Auth::user()->can('read-role'))
        // {
        //     abort(401);
        // }
        return view('admin.roles.index', [
            'active' => 'roles', 
            'roles' => Role::where('slug', '!=', 'superadmin')
            ->where('slug', '!=', 'user')->get()
        ]);
    }

    public function loadTable()
    {
        return view('admin.roles.table', [
            'roles' => Role::where('slug', '!=', 'superadmin')
            ->where('slug', '!=', 'user')->get()
        ]);
    }

    public function create()
    {
        return view('admin.roles.create', ['active'=>'roles', 'permissions' => Permission::get()]);
    }

    public function store(Request $request)
    {
        //creating slug
        $request['slug'] = (string) Str::of($request->name)->slug('-');

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:roles',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        $permissions = $request->permissions;
        foreach($permissions as $permission){
            $role_permission = new Roles_permissions();
            $role_permission->permission_id = $permission;
            $role_permission->role_id = $role->id;
            $role_permission->save();
        }

        return response()->json([
            'status' => 1, 
            'message' => "Success.! role has been added successfully.",            
        ], 200);
    }

    public function edit($id)
    {
        // if(!Auth::user()->can('edit-role'))
        // {
        //     abort(401);
        // }
        return view('admin.roles.edit', ['active' => 'roles', 'role' => Role::where('id',$id)->get()->first(), 'permissions' => Permission::get()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);

        if(!Role::where('id', $id)->exists())
        {
            return response()->json([
                'status' => 0, 
                'message' => "Error.! role does not exists.😯",            
            ], 200);
        }

        $role = Role::where('id', $id)->first();
        $role->name = $request->name;
        $role->slug = str_replace(" ","",strtolower($request->name));
        $role->save();
        
        $role->rolespermissions()->delete();
        $permissions = $request->permissions;
        foreach($permissions as $permission)
        {
            $role_permission = new Roles_permissions();
            $role_permission->permission_id = $permission;
            $role_permission->role_id = $role->id;
            $role_permission->save();
        }

        $users = $role->users()->get();
        
        foreach($users as $user)
        {
            $user->usersepermissions()->delete();
		    $user->permissions()->attach($role->permissions);
        }

        // return $this->echoResponse(1, 'Role updated successfully.!');
        return response()->json([
            'status' => 1, 
            'message' => "Success.! role has been updated successfully.",            
        ], 200);
    }

    public function destroy($id)
    {
        // if(!Auth::user()->can('delete-role'))
        // {
        //     abort(401);
        // }
        if(!Role::where('id', $id)->exists())
        {
            return response()->json([
                'status' => 0, 
                'message' => "Error.! 404 😯 role not found.",            
            ], 200);
        }
        
        $role = Role::where('id', $id)->get()->first();
        $role->delete();

        return response()->json([
            'status' => 1, 
            'message' => "Success.! role has been deleted successfully.",            
        ], 200);
    } 
}
