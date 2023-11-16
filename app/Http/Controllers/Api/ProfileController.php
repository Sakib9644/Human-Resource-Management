<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Display a listing of the profiles.
    public function index()
    {
        $profiles = Profile::all();
        return response()->json(['profiles' => $profiles], 200);
    }

    // Display the specified profile.
    public function show(Profile $profile)
    {
        return response()->json(['profile' => $profile], 200);
    }

    // Update the specified profile in storage.
    public function update(Request $request, Profile $profile)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:profiles,email,' . $profile->id,
            'image' => 'string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'dob' => 'required|string',
            // Add other validation rules as needed
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            // Add other fields as needed
        ]);

        try {
            // your update logic
            return response()-> json (['message' => 'Profile updated successfully', 'profile' => $profile], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function destroy(Profile $profile )
    {
        $profile->delete();

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}
