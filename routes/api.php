<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ModeratorController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Egulias\EmailValidator\Warning\DeprecatedComment;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Admin Routes
Route::middleware(['auth:sanctum', 'checkRole:Admin,Moderator,Employee'])->group(function () {
    // Routes that require the 'admin' or 'moderator' role
    Route::apiResource('profiles', ProfileController::class);
    Route::apiResource('departments', DepartmentController::class);
});


// Role Routes
Route::apiResource('roles', RoleController::class);

// Authentication Routes
Route::post('/auth/login', [AuthController::class, 'loginUser']); // Endpoint for user login
Route::post('/auth/register', [AuthController::class, 'createUser']); // Endpoint for user registration
