<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\MappingUser;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DB;
use Auth;
class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {  
        
        if (Auth::user()->hasRole('admin') ) {
            // $users = User::join("mapping_user","users.id","=","mapping_user.user_id")
            // ->whereHas('roles', function($role) {
            //     $role->where('name', '=', "so");
            // })
            // ->where("mapping_user.mapping_user_id","=",Auth::user()->id)
            // ->paginate(10);
     
            $users = User::join("mapping_user","users.id","=","mapping_user.user_id")->paginate(10000000);
 
            // $users= DB::select("select * from users where lastname=1");
       
        } elseif (Auth::user()->hasRole('so')) {
            $users = User::join("mapping_user","users.id","=","mapping_user.user_id")
            ->whereHas('roles', function($role) {
                $role->where('name', '=', "doctor");
            })->where("mapping_user.mapping_user_id","=",Auth::user()->id)
            ->paginate(10);
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        if (Auth::user()->hasRole('admin') ) {
            $role= Role::whereIn('name',["so"])->latest()->get();
        } elseif (Auth::user()->hasRole('so')) {
            $role= Role::whereIn('name',["doctor"])->latest()->get();
        }
       
        return view('users.create',["roles"=>$role]);
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            // 'password' => 'required|same:confirm-password',
            'password' => 'required',
            'role' => 'required',
            'division' => 'required',
            'headquarter' => 'required',
            'designer' => 'required'
        ]);
    
        $input = $request->all();      
        $input['password'] =  bcrypt($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('role'));
        MappingUser::create(["mapping_user_id"=>\Auth::user()->id,"user_id"=>$user->id,"created_at"=>date("Y-m-d H:i:s"),"created_by"=>\Auth::user()->id]);   
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        if (Auth::user()->hasRole('admin') ) {
            $role=Role::whereIn('name',["so"])->latest()->get();
        } elseif (Auth::user()->hasRole('so')) {
            $role=Role::whereIn('name',["doctor"])->latest()->get();
        }
        
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => $role
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,'.$id,
        //     'password' => 'same:confirm-password',
        //     'roles' => 'required'
        // ]);
    
        $input = $request->all();
        // if(!empty($input['password'])){ 
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));    
        // }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('role'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();
        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}