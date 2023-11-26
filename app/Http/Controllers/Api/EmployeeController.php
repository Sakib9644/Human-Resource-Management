<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    // Display a listing of the profiles.
    public function index()
    {
        $employees = Employee::all();
        return response()->json(['employees' => $employees], 200);
    }

    // Display the specified profile.
    public function show(Employee $employee)
    {
        return response()->json(['employee' => $employee], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'image' => 'string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'dob' => 'required|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $employee = Employee::create($request->all());

            return response()->json(['message' => 'Employee created successfully', 'employee' => $employee], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Update the specified profile in storage.
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'image' => 'string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required|string',
            'marital_status' => 'required|string',
            'hire_date' => 'required|string',
            'termination_date' => 'required|string',
            'status' => 'required|string',
            'department_id' => 'required|string',
            'position_id' => 'required|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $employee->update($request->all());

        try {
            // your update logic
            return response()->json(['message' => 'Profile updated successfully', 'employee' => $employee], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}
