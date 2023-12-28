<?php

// app/Http/Controllers/Api/TrainingController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Repositories\ModelRepositories\TrainingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    protected $trainingobject;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingobject = $trainingRepository;
    }

    public function index()
    {
        $trainings = $this->trainingobject->all();
        return response()->json(['trainings' => $trainings], 200);
    }

    public function show($id)
    {
        $training = $this->trainingobject->find($id);

        if (!$training) {
            return response()->json(['error' => 'Training not found'], 404);
        }

        return response()->json(['training' => $training], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'training_name' => 'required|string|max:255',
            'training_date' => 'required|date',
            'trainer' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
          
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $training = $this->trainingobject->create($request->all());

        return response()->json(['message' => 'Training created successfully', 'training' => $training], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'training_name' => 'required|string|max:255',
            'training_date' => 'required|date',
            'trainer' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $training = $this->trainingobject->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Training updated successfully',
            'data' =>  $training,
        ], 200);
    }

    public function destroy($id)
    {
        $this->trainingobject->delete($id);
        return response()->json(['message' => 'Training deleted successfully'], 200);
    }
}
