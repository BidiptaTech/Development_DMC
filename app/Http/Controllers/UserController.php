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
            if($this->auth_user->user_type == 1){
                $users = User::with('roles')->where('user_type', '>=', $this->auth_user->user_type)->get();
            }else{
                $users = User::with('roles')->where('user_type', '>', $this->auth_user->user_type)->get();
            }
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
            $ipAddress = request()->ip();
            $usercountryCode = CommonHelper::getCountryInfo($ipAddress);
            $user_countryCode = $usercountryCode['country_code'];
            $countryCodes = User::countryCodes();
            $authUserType =  $this->auth_user->user_type; 
            $userTypes = array_filter(User::getUserTypes(), function($key) use ($authUserType) {
                if($authUserType == 1){
                    return $key >= $authUserType;
                }else{
                    return $key > $authUserType;
                }
            }, ARRAY_FILTER_USE_KEY);
            if($authUserType == 1){
                $roles = Role::where('user_type', '>=', $this->auth_user->user_type)->get();
            }else{
                $roles = Role::where('user_type', '>', $this->auth_user->user_type)->get();
            }
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
            // 'role' => 'required|exists:roles,id', 
            'user_type' => 'required',
            'phone' => 'required|max:15', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8', 
        ]);
        //for unique user id calling helper
        $user_max_id = User::max('userId') ?? 1;
        $usersId = CommonHelper::createId($user_max_id);
        while (User::where('userId', $usersId)->exists()) {
            $usersId = CommonHelper::createId($usersId);
        }

        if($request->input('user_type') == 3){
            $dmcId = $this->auth_user->user_id;
        }
        $user = User::create([
            'name' => $request->input('yourname'),
            'role_id' => $request->input('role'), 
            'markup_type' => $request->input('markup_type'), 
            'markup_price' => $request->input('markup_price'), 
            'user_type' => $request->input('user_type'),
            'country_code' => $request->input('code'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'userId' => $usersId,
            'dmcId' => $dmcId ?? 0,
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
                if($this->auth_user->user_type == 1){
                    return $key >= $authUserType;
                }else{
                    return $key > $authUserType;
                }
            }, ARRAY_FILTER_USE_KEY);
            $countryCodes = User::countryCodes();
            if($this->auth_user->user_type == 1){
            $roles = Role::where('user_type', '>', $this->auth_user->user_type)->get();
            }else{
            $roles = Role::where('user_type', '>=', $this->auth_user->user_type)->get();
            }
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
            'userId' => $user->userId,
            'markup_type' => $request->input('markup_type'), 
            'markup_price' => $request->input('markup_price'), 
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
            $user = User::where('id', $validatedData['userId'])->first();
            DB::transaction(function () use ($validatedData, $user) {
                $wallet = Wallet::create([
                    'user_id' => $user->userId, 
                    'balance' => $validatedData['amount'], 
                ]);
                if($wallet){
                    $transaction = Transaction::create([
                        'user_id' => $user->userId, 
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
        $transaction = Transaction::where('user_id', $this->auth_user->userId)
        ->orWhere('credited_from', $this->auth_user->user_id)
        ->get();
        return view('users.transaction',compact('transaction'));
    }

    /*
    * Admin access to Another User login.
    * Date 30-10-2024
    */
    public function loginAsUser($userId)
    {
        if (!auth()->user()->user_type == 1) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($userId);
        session(['from_admin' => true]);
        auth()->login($user);
        return redirect('/')->with('message', 'You are now logged in as ' . $user->name);
    }

    public function adminlogin()
    {
        session()->forget('from_admin');
        $user = User::findOrFail(1);
        auth()->login($user);
        return redirect('/')->with('message', 'You are now logged in as ' . $user->name); 
    }


}
