<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
class FeaturesController extends Controller
{
    /*
    * Display a listing of the Features.
    * Date 07-10-2024
    */
    public function index(Request $request)
    {
        if (!Auth::user()->can('view features')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $features = Permission::orderBy('id','DESC')->get();
            $roles = Role::get();
            return view('feature.index',compact('features', 'roles'));
        }
    }

    /*
    * Status update of Features.
    * Date 15-11-2024
    */
    public function statusUpdate(Request $request)
    {
        if (!Auth::user()->can('view features')) {
            abort(403, 'You do not have permission to access this page.');
        }
        $id = $request->id;
        $feature = Permission::find($id);
        if (!$feature) {
            return response()->json(['success' => false, 'message' => 'Feature not found.'], 404);
        }
        $permissionCheck = DB::table('role_has_permissions')->where('permission_id', $feature->id)->exists();
        if ($permissionCheck) {
            return response()->json(['success' => false, 'message' => 'You cannot change the status of this feature as it is already in use.'], 403);
        }
        $feature->status = $feature->status == 1 ? 0 : 1;
        $feature->save();
        return response()->json(['success' => true, 'message' => 'Feature status updated successfully.']);
    }

    /*
    * Updeate roles for specific features.
    * Date 17-10-2024
    */
    public function saveFeatureRoles(Request $request, $id) 
    {
        $request->validate([
            'roles' => 'required|array', 
        ]);
        $feature = Permission::find($id);
        if (!$feature) {
            return redirect()->back()->withErrors('Feature not found');
        }
        $feature->feature_roles = json_encode($request->roles);
        $feature->save();
        return redirect()->back()->with('success', 'Feature roles updated successfully.');
    }

}