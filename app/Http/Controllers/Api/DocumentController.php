<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Documents retrieved successfully',
            'data' => $documents,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'document_name' => 'required|string|max:255',
            'file_path' => 'required|string',
            'upload_date' => 'required|date',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $document = Document::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Document created successfully',
            'data' => $document,
        ], 201);
    }

    public function show(Document $document)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Document retrieved successfully',
            'data' => $document,
        ], 200);
    }

    public function update(Request $request, Document $document)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => 'exists:employees,id',
            'document_name' => 'string|max:255',
            'file_path' => 'string',
            'upload_date' => 'date',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $document->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Document updated successfully',
            'data' => $document,
        ], 200);
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Document deleted successfully',
        ], 200);
    }
}
