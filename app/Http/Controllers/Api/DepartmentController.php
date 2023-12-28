<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Repositories\ModelRepositories\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    protected $departmentObject;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentObject = $departmentRepository;
    }

    public function index(Request $request)
    {
        $departments = $this->departmentObject->all();

        return response()->json([
            'status' => 'success',
            'message' => 'Departments retrieved successfully',
            'data' => $departments,
        ], JsonResponse::HTTP_OK);
    }

    public function show($id)
    {
        $department = $this->departmentObject->find($id);

        if (!$department) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Department retrieved successfully',
            'data' => $department,
        ], JsonResponse::HTTP_OK);
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
            return response()->json(['error' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $createdDepartment = $this->departmentObject->create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Department created successfully',
            'data' => $createdDepartment,
        ], JsonResponse::HTTP_CREATED);
    }

    public function edit($id)
    {
        $department = $this->departmentObject->find($id);

        if (!$department) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json(['department' => $department], JsonResponse::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255|unique:departments,name,' . $id,
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $department = $this->departmentObject->find($id);

        if (!$department) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        // Update the department with validated data
        $updatedDepartment = $this->departmentObject->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Department updated successfully',
            'data' => $updatedDepartment,
        ], JsonResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        $department = $this->departmentObject->find($id);

        if (!$department) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->departmentObject->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Department deleted successfully',
        ], JsonResponse::HTTP_OK);
    }
}
