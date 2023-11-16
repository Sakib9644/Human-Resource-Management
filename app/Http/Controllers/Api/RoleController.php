<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all()  ;

        return response()->json(['roles' => $roles], 200);
    }

    /**
     * Display the specified role.
     *
     * @param  \Spatie\Permission\Models\Permission  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $role)
    {
        return response()->json(['role' => $role], 200);
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
       $permission = Permission::all();

        return response()->json(['permission' => $permission], 201);
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Permission  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $role)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);

        // Update the role (permission)
        $role->update([
            'name' => $request->input('name'),
        ]);

        return response()->json(['role' => $role], 200);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $role)
    {
        // Delete the role (permission)
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
