<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function index(){
        $roles = Role::all();


        return view('admin.users.roleList', compact('roles'));
    }

    function create(){
        return view('admin.users.roleCreate');

    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        return redirect()->route('role.index')->with('success', $role->name . ' افزوده شد.');
    }

    function permissions($roleId){
        $role = Role::findById($roleId);
        $permissions = $role->permissions()->get();


        // $role = Role::create(['name' => 'writer']);
        // dd($role);

        // $permission = Permission::create(['name' => 'edit company']);

        // $permission->assignRole($role);


        // $role->givePermissionTo($permission);
        return view('admin.users.permissionList',compact('role','permissions'));
    }

    function permissionStore(Request $request){

    }
}
