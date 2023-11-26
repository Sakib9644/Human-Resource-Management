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
        return response()->json(['positions' => $positions], 200);
    }

    public function show(Position $position)
    {
        return response()->json(['position' => $position], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:positions',
            'description' => 'nullable|string',
            'salary' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $position = Position::create($request->all());
            return response()->json(['message' => 'Position created successfully', 'position' => $position], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Position $position)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|',
            'description' => 'nullable|string',
            'salary' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $position->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Position updated successfully',
            'data' =>  $position,
        ], 200);
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return response()->json(['message' => 'Position deleted successfully'], 200);
    }
}
