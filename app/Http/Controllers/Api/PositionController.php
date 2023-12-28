<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ModelRepositories\PositionRepository;
use App\Repositories\PositionRepositoryInterface;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    protected $positionobject;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionobject = $positionRepository;
    }

    public function index()
    {
        $positions = $this->positionobject->all();
        return response()->json(['positions' => $positions], 200);
    }

    public function show($id)
    {
        $position = $this->positionobject->find($id);

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }

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
            $position = $this->positionobject->create($request->all());
            return response()->json(['message' => 'Position created successfully', 'position' => $position], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
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

        $position = $this->positionobject->update($id, $request->all());

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Position updated successfully',
            'data' => $position,
        ], 200);
    }

    public function destroy($id)
    {
        $position = $this->positionobject->find($id);

        if (!$position) {
            return response()->json(['error' => 'Position not found'], 404);
        }

        $this->positionobject->delete($id);
        return response()->json(['message' => 'Position deleted successfully'], 200);
    }
}
