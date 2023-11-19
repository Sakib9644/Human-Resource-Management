<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

// Inside the DepartmentController

use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    // Other methods...

    public function store(Request $request)
    {
        // Validation logic here

        $department = Department::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Department created successfully',
            'data' => $department,
        ], 201);
    }

    public function show(Department $department)
    {
        return response()->json(['department' => $department], 200);

        
    }

    public function update(Request $request, Department $department)
    {
        // Validation logic here

        $department->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Department updated successfully',
            'data' => $department,
        ], 200);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Department deleted successfully',
        ], 200);
    }

    public function index()
    {
        $departments = Department::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Departments retrieved successfully',
            'data' => $departments,
        ], 200);
    }
}
