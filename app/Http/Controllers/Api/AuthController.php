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
use Spatie\Permission\Models\Role;

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
                    'user_id' => 'nullable',
                    'role' => 'required|exists:roles,name', // Assuming 'roles' is the name of the roles table


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
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ]);
            
            // Use the relationship method to create an associated employee
            $user->employee()->create([
                'name' => $request->name,
                'email' => $request->email,
                // Other fields...
            ]);
            
            // Assign the role to the user if provided
            if ($request->filled('role')) {
                $role = Role::where('name', $request->role)->first();
            
                if (!$role) {
                    return response()->json(['status' => false, 'message' => 'Role does not exist'], 422);
                }
            
                $user->assignRole($role);
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
            $user = User::with(['roles.permissions'])->where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email and password do not match our records.',
                ], 401);
            }

            // Hide the pivot attribute before responding
            $user->roles->each(function ($role) {
                $role->makeHidden('pivot');
            });
            // Profile::create([
            //     'name' => $request->name,
            //     'user_id' => $user->id,
            //     'email' => $request->email,
            //     // 'type' => $request->type, // Uncomment if needed
            // ]);

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                // 'user' => [
                //     'id' => $user->id,
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'role' => $user->roles->first()->name, // Assuming a user has only one role
                //     'permissions' => $user->roles->first()->permissions->pluck('name'),
                // ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
