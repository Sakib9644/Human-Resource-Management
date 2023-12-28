<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Repositories\ModelRepositories\DocumentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    protected $documentObject;

    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentObject = $documentRepository;
    }

    public function index()
    {
        $documents = $this->documentObject->all();

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
            'employee_id' => 'required',
            'document_name' => 'required|string|max:255',
            'file_path' => 'required|string',
            'upload_date' => 'required|date',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $document = $this->documentObject->create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Document created successfully',
            'data' => $document,
        ], 201);
    }

    public function show($id)
    {
        $document = $this->documentObject->find($id);

        if (!$document) {
            return response()->json([
                'status' => 'error',
                'message' => 'Document not found',
            ], 404);
        }

        return response()->json(['document' => $document], 200);
    }

    public function edit($id)
    {
        $document = $this->documentObject->find($id);

        if (!$document) {
            return response()->json([
                'status' => 'error',
                'message' => 'Document not found',
            ], 404);
        }

        return response()->json(['document' => $document], 200);
    }

    public function update(Request $request, $id)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'employee_id' => '',
            'document_name' => 'string|max:255',
            'file_path' => 'string',
            'upload_date' => 'date',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $document = $this->documentObject->find($id);

        if (!$document) {
            return response()->json([
                'status' => 'error',
                'message' => 'Document not found',
            ], 404);
        }

        $document = $this->documentObject->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Document updated successfully',
            'data' => $document,
        ], 200);
    }

    public function destroy($id)
    {
        $document = $this->documentObject->find($id);

        if (!$document) {
            return response()->json([
                'status' => 'error',
                'message' => 'Document not found',
            ], 404);
        }

        $this->documentObject->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Document deleted successfully',
        ], 200);
    }
}
