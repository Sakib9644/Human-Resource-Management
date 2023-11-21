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

        return response()->json(['positions' => $positions]);
    }

    public function show($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }

        return response()->json(['position' => $position]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'salary' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $position = Position::create($request->all());

        return response()->json(['position' => $position], 201);
    }

    public function update(Request $request, $id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required',
            'description' => 'sometimes|nullable',
            'salary' => 'sometimes|required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $position->update($request->all());

        return response()->json(['position' => $position]);
    }

    public function destroy($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }

        $position->delete();

        return response()->json(['message' => 'Position deleted']);
    }
}
