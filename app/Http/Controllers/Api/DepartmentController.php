<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Positions retrieved successfully',
            'positions' => $positions,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:positions',
            'description' => 'nullable|string',
            'salary' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $position = Position::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Position created successfully',
            'position' => $position,
        ], 201);
    }

    public function show(Position $position)
    {
        return response()->json(['position' => $position], 200);
    }

    public function update(Request $request, Position $position)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255|unique:positions,title,' . $position->id,
            'description' => 'sometimes|nullable|string',
            'salary' => 'sometimes|required|numeric',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $position->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Position updated successfully',
            'position' => $position,
        ], 200);
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Position deleted successfully',
        ], 200);
    }
}
