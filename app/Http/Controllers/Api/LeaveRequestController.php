<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Leave requests retrieved successfully',
            'data' => $leaveRequests,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|in:sick_leave,vacation,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,approved,rejected',
            'reason' => 'required|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $leaveRequest = LeaveRequest::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Leave request created successfully',
            'data' => $leaveRequest,
        ], 201);
    }

    public function show(LeaveRequest $leaveRequest)
    {
        return response()->json(['leaverequest' => $leaveRequest], 200);
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|in:sick_leave,vacation,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,approved,rejected',
            'reason' => 'required|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $leaveRequest->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Leave request updated successfully',
            'data' => $leaveRequest,
        ], 200);
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Leave request deleted successfully',
        ], 200);
    }
}
