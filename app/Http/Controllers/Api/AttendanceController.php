<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Attendances retrieved successfully',
            'data' => $attendances,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'clock_in_time' => 'nullable|date_format:H:i:s',
            'clock_out_time' => 'nullable|date_format:H:i:s',
            'status' => 'required|in:present,absent,late,early_leave,holiday,half_day',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $attendance = Attendance::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance created successfully',
            'data' => $attendance,
        ], 201);
    }

    public function show(Attendance $attendance)
    {
        return response()->json(['attendance' => $attendance], 200);
    }

    public function update(Request $request, Attendance $attendance)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'clock_in_time' => 'nullable|date_format:H:i:s',
            'clock_out_time' => 'nullable|date_format:H:i:s',
            'status' => 'required|in:present,absent,late,early_leave,holiday,half_day',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $attendance->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance updated successfully',
            'data' => $attendance,
        ], 200);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance deleted successfully',
        ], 200);
    }
}
