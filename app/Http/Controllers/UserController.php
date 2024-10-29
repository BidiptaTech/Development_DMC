<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use app\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Helpers\CommonHelper;
use Illuminate\Routing\Controllers\Middleware;
use DB;
use Auth;

class UserController extends Controller
{
    /*  
    *construct function
    */
    protected $auth_user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth_user = Auth::user();
            return $next($request);
        });
    }

    /* 
    * Display a listing of the Users.
    * Date: 04-10-2024 
    */
    public function index()
    { 
        if (!Auth::user()->can('view users')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $users = User::with('roles')->where('user_type', '>=', $this->auth_user->user_type)->get();
            return view('users.users',compact('users'));
        }
    }

    /*
    * Show the form for creating a new User.
    * Date 08-10-2024
    */
    public function create()
    {
        if (!Auth::user()->can('create users')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $ipAddress = '36.255.66.84';
            $user_countryCode = CommonHelper::getCountryInfo($ipAddress);
            $countryCodes = User::countryCodes();
            $authUserType =  $this->auth_user->user_type; 
            $userTypes = array_filter(User::getUserTypes(), function($key) use ($authUserType) {
                return $key >= $authUserType;
            }, ARRAY_FILTER_USE_KEY);
            $roles = Role::where('user_type', '>=', $this->auth_user->user_type)->get();
            return view('users.add-user',compact('countryCodes', 'userTypes', 'roles', 'user_countryCode'));
        }
    }

    /*
    * Store a newly created User.
    * Date 08-10-2024
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'yourname' => 'required|max:255',
            'role' => 'required|exists:roles,id', 
            'user_type' => 'required',
            'code' => 'required',
            'phone' => 'required|max:15', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8', 
        ]);
        $user = User::create([
            'name' => $request->input('yourname'),
            'role_id' => $request->input('role'), 
            'user_type' => $request->input('user_type'),
            'country_code' => $request->input('code'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        //insert user role
        $role = Role::find($request->input('role'));
        if ($role) {
            $user->assignRole($role->name);
        } else {
            return redirect()->back()->withErrors(['role' => 'The selected role does not exist.']);
        }

        $users = User::all();
        return redirect()->route('users.index',compact('users'))
            ->with('success', 'User created successfully');
    }

    /*
    * Show the form for editing the specified User.
    * Date 08-10-2024
    */
    public function edit($id)
    {
        if (!Auth::user()->can('edit users')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $users = User::find($id);
            $authUserType =  $this->auth_user->user_type; 
            $userTypes = array_filter(User::getUserTypes(), function($key) use ($authUserType) {
                return $key >= $authUserType;
            }, ARRAY_FILTER_USE_KEY);
            $countryCodes = User::countryCodes();
            $roles = Role::where('user_type', '>=', $this->auth_user->user_type)->get();
            return view('users.edit-user',compact('users','roles','userTypes','countryCodes'));
        }
    }

    /*
    * Update the specified user.
    * Date 08-10-2024
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'yourname' => 'required|max:255',
            'role' => 'required|exists:roles,id', 
            'user_type' => 'required',
            'code' => 'required',
            'phone' => 'required|max:15', 
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('yourname'),
            'role_id' => $request->input('role'), 
            'user_type' => $request->input('user_type'),
            'country_code' => $request->input('code'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
        ]);
        //update user role
        $role = Role::find($request->input('role'));
        if ($role) {
            $user->syncRoles([$role->name]); 
        }
        $users = User::all();
        return redirect()->route('users.index',compact('users'))
            ->with('success', 'User updated successfully');
    }

    /*
    * Soft Delete User.
    * Date 14-10-2024
    */
    public function destroy($id)
    {
        if (!Auth::user()->can('delete users')) {
            abort(403, 'You do not have permission to access this page.');
        }else{
            $delete = User::where('id', $id)->delete();
            if($delete){
                return redirect()->route('users.index')->with('success','User deleted successfully');
            }else{
                return redirect()->route('users.index')->with('error','Something went wrong');
            }
        }
    }

    /*
    * Dependent roles respect of usertype.
    * Date 07-10-2024
    */
    public function getRolesByUserType($userType)
    {
        $roles = Role::where('user_type', $userType)->get();
        return response()->json(['roles' => $roles]);
    }

    /*
    * Add wallet money.
    * Date 28-10-2024
    */
    public function add_money(Request $request, $id)
    {
        $validatedData = $request->validate([
            'userId' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);
        $walletBalance = \App\Models\Transaction::where('user_id', Auth::id())->sum('amount');
        if($walletBalance < $validatedData['amount'] && $this->auth_user->id != 1){
            return redirect()->back()->with('error', 'You dont have much balance, please add balance.');
        }else{
            DB::transaction(function () use ($validatedData) {
                $wallet = Wallet::create([
                    'user_id' => $validatedData['userId'], 
                    'balance' => $validatedData['amount'], 
                ]);
                if($wallet){
                    $transaction = Transaction::create([
                        'user_id' => $validatedData['userId'], 
                        'type' => 'transaction', 
                        'amount' => $validatedData['amount'], 
                        'credited_from' => $this->auth_user->id, 
                    ]);
                }
            });
        }
        return redirect()->back()->with('success', 'Amount added in wallet');
    }

    /*
    * All Transaction Record.
    * Date 28-10-2024
    */
    public function transaction()
    {
        $transaction = Transaction::where('user_id', $this->auth_user->id)
        ->orWhere('credited_from', $this->auth_user->id)
        ->get();
        return view('users.transaction',compact('transaction'));
    }

}
