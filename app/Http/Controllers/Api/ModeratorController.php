<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Moderator;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    // Display a listing of the moderators.
    public function index()
    {
        $moderators = Moderator::all();
        return response()->json(['moderators' => $moderators], 200);
    }

    // Store a newly created moderator in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:moderators,email',
            // Add other validation rules as needed
        ]);

        $moderator = Moderator::create([
            'name' => $request->name,
            'email' => $request->email,
            // Add other fields as needed
        ]);

        return response()->json(['moderator' => $moderator], 201);
    }

    // Display the specified moderator.
    public function show(Moderator $moderator)
    {
        return response()->json(['moderator' => $moderator], 200);
    }

    // Update the specified moderator in storage.
    public function update(Request $request, Moderator $moderator)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:moderators,email,' . $moderator->id,
            // Add other validation rules as needed
        ]);

        $moderator->update([
            'name' => $request->name,
            'email' => $request->email,
            // Add other fields as needed
        ]);

        return response()->json(['moderator' => $moderator], 200);
    }

    // Remove the specified moderator from storage.
    public function destroy(Moderator $moderator)
    {
        $moderator->delete();

        return response()->json(['message' => 'Moderator deleted successfully'], 200);
    }
}
