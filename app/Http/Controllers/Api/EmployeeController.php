<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display a listing of the employees.
    public function index()
    {
        $employees = Employee::all();
        return response()->json(['employees' => $employees], 200);
    }

    // Store a newly created employee in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            // Add other validation rules as needed
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            // Add other fields as needed
        ]);

        return response()->json(['employee' => $employee], 201);
    }

    // Display the specified employee.
    public function show(Employee $employee)
    {
        return response()->json(['employee' => $employee], 200);
    }

    // Update the specified employee in storage.
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            // Add other validation rules as needed
        ]);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            // Add other fields as needed
        ]);

        return response()->json(['employee' => $employee], 200);
    }

    // Remove the specified employee from storage.
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}

