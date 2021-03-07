<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function index()
    {
        $roles = Role::all();

        return view('admin.users.roleList', compact('roles'));
    }

    function create()
    {
        return view('admin.users.roleCreate');
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        return redirect()->route('role.index')->with('success', $role->name . ' افزوده شد.');
    }
    public function destroy(Role $role)
    {
        //todo remove from user
        //todo remove permission

        dd('destroy');
    }

    public function permissions(Role $role)
    {
        return view('admin.users.permissionList', compact('role'));
    }

    public function permissionStore(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $permission = Permission::findOrCreate($request->name);
        $role->givePermissionTo($permission);

        return redirect()->route('role.permissions.index', $role->id)->with('success', Lang::get('messages.added'));
    }

    public function users(Role $role)
    {
        $allUsers = User::all();


        return view('admin.users.roleUsersList', compact('role', 'allUsers'));
    }
}
