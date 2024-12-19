<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected $auth_user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth_user = Auth::user();
            return $next($request);
        });
    }

    /*
    * Display a listing of the Roles.
    * Date 07-10-2024
    */
    public function index(Request $request)
    {
        // DB::table('roles')->delete();
        // DB::table('role_has_permissions')->delete();
        // DB::table('permissions')->delete();
        // DB::table('model_has_permissions')->delete();
        // DB::table('model_has_roles')->delete();
        
        /*
        * Checked user have view roles access or not.
        */
        if (!Auth::user()->can('view roles')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $roles = Role::where('user_type', '>=', $this->auth_user->user_type)->orderBy('id','DESC')->get();
            return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 3);
        }
    }

    /*
    * Show the form for creating a new role.
    * Date 07-10-2024
    */
    
    public function create()
    {
        if (!Auth::user()->can('create roles')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
        $permission = Permission::where('status', 1)->get();
        $authUserType =  $this->auth_user->user_type; 
        $userTypes = array_filter(User::getUserTypes(), function($key) use ($authUserType) {
            return $key >= $authUserType;
        }, ARRAY_FILTER_USE_KEY);

        return view('roles.create',compact('permission','userTypes'));
        }
    }

    /*
    * Store a newly created role.
    * Date 07-10-2024
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'user_type' => 'required',
            // 'permission' => 'required|array',
        ]);
        $role = Role::create([
            'name' => $request->input('name'),
            'user_type' => $request->input('user_type'),
        ]);
        // $permissions = Permission::whereIn('id', $request->input('permission'))->pluck('name')->toArray();
        // $role->syncPermissions($permissions);
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    /*
    * Show the form for editing the specified role.
    * Date 07-10-2024
    */
    public function edit($id)
    {
        if (!Auth::user()->can('edit roles')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $role = Role::find($id);
            if (!$role) {
                abort(404, 'Role not found.');
            }
            $permissions = Permission::where('status', 1)->get();
            $authUserType = $this->auth_user->user_type; 
            $userTypes = array_filter(User::getUserTypes(), function($key) use ($authUserType) {
                return $key >= $authUserType;
            }, ARRAY_FILTER_USE_KEY);
            $assignedRolePermissions = Permission::whereJsonContains('feature_roles', $id)->pluck('id')->toArray();
            
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
        }
        return view('roles.edit', compact('role', 'permissions', 'assignedRolePermissions', 'rolePermissions', 'userTypes'));
    }


    /*
    * Update the specified role.
    * Date 07-10-2024
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required|array', // Ensure it's an array
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->user_type = $request->input('user_type');
        $role->save();
        $permissions = Permission::whereIn('id', $request->input('permission'))->pluck('name')->toArray();
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    /*
    * Soft Delete Roles.
    * Date 07-10-2024
    */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete roles')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $delete =Role::where('id', $id)->delete();
            return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
        }
    }

}
