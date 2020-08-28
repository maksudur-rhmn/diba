<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleFormRequest;
use App\Http\Requests\AssignFormRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('createPermissions');
        $this->middleware('verified')->except('createPermissions');
    }

    public function index()
    {
        return view('roles.index',[
            'permissions' => Permission::all(),
            'roles'       => Role::all(),
            'users'       => User::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    // While visiting the given url to create permissions this method will run 
    
    public function createPermissions()
    {
        Permission::create(['name' => 'view']); 
        Permission::create(['name' => 'edit']); 
        Permission::create(['name' => 'delete']);
        
        return redirect('/login')->withSuccess('Permissions have been created !!! Visit Role manager to create roles and assign them to the users');

    }

    // Creating Roles and giving permssions to the roles

    public function store(RoleFormRequest $request)
    {

       $role =  Role::create(['name' => $request->role_name]);

       $role->givePermissionTo($request->permissions);

       return back()->withSuccess('Roles created Successfully');
    }

    // Assigning Roles to users 

    public function roleAssign(AssignFormRequest $request)
    {
        $user = User::findOrFail($request->user_name); 
        $user->syncRoles($request->role_name);

        return back()->withSuccess('Role assigned to the user');
    }

    // Revoke Roles 

    public function roleRevoke($user_id)
    {
        $user = User::find($user_id);

        $user->syncRoles('User');

        return back()->withWarning('User Demoted');
    }

}
