<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Repositories\ModelRepositories\AttendanceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AttendanceController extends Controller
{
    protected $attendanceobject;

    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceobject = $attendanceRepository;
    }

    public function index()
    {
        $attendances = $this->attendanceobject->all();

        return response()->json([
            'status' => 'success',
            'message' => 'Attendances retrieved successfully',
            'data' => $attendances,
        ], JsonResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $attendance = $this->attendanceobject->create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance created successfully',
            'data' => $attendance,
        ], JsonResponse::HTTP_CREATED);
    }

    public function show($id)
    {
        $attendance = $this->attendanceobject->find($id);

        if (!$attendance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Attendance not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance retrieved successfully',
            'data' => $attendance,
        ], JsonResponse::HTTP_OK);
    }

    public function edit($id)
    {
        $attendance = $this->attendanceobject->find($id);

        if (!$attendance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json(['department' => $attendance], JsonResponse::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $attendance = $this->attendanceobject->find($id);

        if (!$attendance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Attendance not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        $updatedAttendance = $this->attendanceobject->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance updated successfully',
            'data' => $updatedAttendance,
        ], JsonResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        $attendance = $this->attendanceobject->find($id);

        if (!$attendance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Attendance not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->attendanceobject->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance deleted successfully',
        ], JsonResponse::HTTP_OK);
    }

    private function getValidationRules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'clock_in_time' => 'nullable|date_format:h:iA', // Exclude seconds
            'clock_out_time' => 'nullable|date_format:h:iA', // Exclude seconds
            'status' => 'required',
        ];
    }
}
