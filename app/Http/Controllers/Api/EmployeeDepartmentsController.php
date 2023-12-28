<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ModelRepositories\EmployeeDepartmentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class EmployeeDepartmentsController extends Controller
{
    protected $employeeDepartmentObject;

    public function __construct(EmployeeDepartmentsRepository $employeeDepartmentRepository)
    {
        $this->employeeDepartmentObject = $employeeDepartmentRepository;
    }

    public function index()
    {
        $employeeDepartments = $this->employeeDepartmentObject->all();

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
            'department_id' => 'required',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $employeeDepartment = $this->employeeDepartmentObject->create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee department created successfully',
            'data' => $employeeDepartment,
        ], 201);
    }

    public function show($id)
    {
        $employeeDepartment = $this->employeeDepartmentObject->find($id);

        if (!$employeeDepartment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee department not found',
            ], 404);
        }

        return response()->json(['employeeDepartment' => $employeeDepartment], 200);
    }

    public function edit($id)
    {
        $employeeDepartment = $this->employeeDepartmentObject->find($id);

        if (!$employeeDepartment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee department not found',
            ], 404);
        }

        return response()->json(['employeeDepartment' => $employeeDepartment], 200);
    }

    public function update(Request $request, $id)
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

        $employeeDepartment = $this->employeeDepartmentObject->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee department updated successfully',
            'data' => $employeeDepartment,
        ], 200);
    }

    public function destroy($id)
    {
        $employeeDepartment = $this->employeeDepartmentObject->find($id);

        if (!$employeeDepartment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee department not found',
            ], 404);
        }

        $this->employeeDepartmentObject->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee department deleted successfully',
        ], 200);
    }
}
