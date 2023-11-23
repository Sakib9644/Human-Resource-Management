<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Departments retrieved successfully',
            'data' => $departments,
        ], 200);
    }
    public function show(Department $department)
    {
        return response()->json(['department' => $department], 200);
    }
    public function store(Request $request)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $department = Department::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Department created successfully',
            'data' => $department,
        ], 201);
    }

  
    public function edit(Department $department)
    {
        return response()->json(['department' => $department], 200);
    }
    public function update(Request $request, Department $department)
{
    // Validation logic
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
        'description' => 'nullable|string',
        // Add other validation rules as needed
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Update the department with validated data
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
}
