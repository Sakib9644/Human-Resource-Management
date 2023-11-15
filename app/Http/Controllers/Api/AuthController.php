<?php

namespace App\Http\Controllers\Api;



use App\Models\Employee;
use App\Models\User;
use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

// ...


class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            // Validated
            $validateUser = Validator::make(
                $request->all(),
                
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|same:password', // Corrected field name
                    'type' => 'nullable|in:admin,moderator,employee',
                    'user_id' => 'nullable'
                    
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type'=>    $request->type,
                'password' => Hash::make($request->password),
                'remember_token' => str::random(60),
              
            ]);
            
            if ($request->type === 'moderator') {
                Profile::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    // Add other fields as needed
                ]);
            } elseif ($request->type === 'employee') {
                Profile::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    // Add other fields as needed
                ]);
            }
            // Check 'type' and create entries accordingly
       

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
