<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        
        $selectedRole = null;
        if ($request->has('role_id')) {
            $selectedRole = Role::with('permissions')->find($request->role_id);
        }

        return view('roles.index', compact('roles', 'permissions', 'selectedRole'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('roles.index', ['role_id' => $role->id])
            ->with('success', 'Permissions updated successfully!');
    }
}
