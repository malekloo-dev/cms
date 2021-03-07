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

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        return redirect()->route('role.index')->with('success', $role->name . Lang::get('messages.added'));
    }
    public function destroy(Role $role)
    {
        $role->revokePermissionTo($role->permission);

        //todo remove from user

        $role->delete();

        return redirect()->route('role.index')->with('success', $role->name . Lang::get('messages.deleted'));
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
