<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeDepartments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class EmployeeDepartmentsController extends Controller
{
    public function index()
    {
        $employeeDepartments = EmployeeDepartments::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee departments retrieved successfully',
            'data' => $employeeDepartments,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'department_id' => 'required|',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $employeeDepartment = EmployeeDepartments::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee department created successfully',
            'data' => $employeeDepartment,
        ], 201);
    }

    public function show(EmployeeDepartments $employeeDepartment)
    {
        return response()->json(['employeeDepartment' => $employeeDepartment], 200);
    }

    public function update(Request $request, EmployeeDepartments $employeeDepartment)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'department_id' => 'required',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $employeeDepartment->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee department updated successfully',
            'data' => $employeeDepartment,
        ], 200);
    }

    public function destroy(EmployeeDepartments $employeeDepartment)
    {
        $employeeDepartment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee department deleted successfully',
        ], 200);
    }
}
