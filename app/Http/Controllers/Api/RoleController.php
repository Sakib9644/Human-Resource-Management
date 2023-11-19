<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
        $roles = Role::with('permissions:name')->latest()->get();
      

        return response()->json(['roles' => $roles], 200);
    }
    // public function create()
    // { 
    //     $roles = Role::with('permissions:name')->latest()->get();

    //     return response()->json(['roles' => $roles], 200);
    // }
    /**
     * Display the specified role.
     *
     * @param  \Spatie\Permission\Models\Permission  $role
     * @return \Illuminate\Http\Response
     */
   public function show(Role $role)
{
    try {
        // Eager load the associated permissions with the role
        $role->load('permissions:name');

        return response()->json([
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
                // Add any other role attributes you want to include
            ],
            'permissions' => $role->permissions->pluck('name'),
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
        ], 500);
    }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission_ids' => 'array|required', // Ensure permission_ids is an array
            'permission_ids.*' => 'exists:permissions,id', // Ensure each ID in the array is a valid permission ID
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        // Create a new role
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
    
        // Assign multiple permissions based on user input by ID
        $permissionIds = $request->input('permission_ids');
        $permissions = Permission::find($permissionIds);
    
        // Attach the permissions to the role
        $role->syncPermissions($permissions);
    
        // Return a success message along with the created role and assigned permissions
        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role->name,
            'permissions' => $permissions->pluck('name')->toArray(),
        ], 200);
    }
    
    
    
    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Permission  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $role->id,'permission_ids' => 'array|required', // Ensure permission_ids is an array
            'permission_ids.*' => 'exists:permissions,id', // Ensure each ID in the array is a valid permission ID
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        // Update the role
        $role->update(['name' => $request->input('name')]);
    
        // Assign multiple permissions based on user input by ID
        $permissionIds = $request->input('permission_ids');
        $permissions = Permission::find($permissionIds);
    
        // Sync the permissions to the role
        $role->syncPermissions($permissions);
    
        // Retrieve the updated role along with its permissions
        $updatedRole = Role::with('permissions')->find($role->id);
    
        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $updatedRole->name,
            'permissions' => $updatedRole->permissions->pluck('name')->toArray(),
        ], 200);
    }
    

    /**
     * Remove the specified role from storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // Delete the role (permission)
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
