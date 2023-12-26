<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        return response()->json(['roles' => $roles], 200);
    }

    public function show(Role $role)
    {
        return response()->json([
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);

        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role->name,
        ], 200);
    }

    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $role->update(['name' => $request->input('name')]);

        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $role->name,
        ], 200);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
