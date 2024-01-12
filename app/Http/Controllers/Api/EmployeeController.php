<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ModelRepositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    protected $employeeObject;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeObject = $employeeRepository;
    }

    public function index()
    {
        $employees = $this->employeeObject->all();
        return response()->json(['employees' => $employees], 200);
    }

    public function show($id)
    {
        $employee = $this->employeeObject->find($id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }

        return response()->json(['employee' => $employee], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            $employee = $this->employeeObject->create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Employee created successfully',
                'data' => $employee,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $employee = $this->employeeObject->find($id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }

        return response()->json(['employee' => $employee], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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

        $employee = $this->employeeObject->find($id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }

        $employee = $this->employeeObject->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Employee updated successfully',
            'data' => $employee,
        ], 200);
    }

    public function destroy($id)
    {
        $employee = $this->employeeObject->find($id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }

        $this->employeeObject->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted successfully',
        ], 200);
    }
}
