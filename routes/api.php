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
Route::middleware(['auth:sanctum', 'checkRole:Admin' ])->group(function () {
    // Routes that require the 'admin' or 'moderator' role
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profile-list');
    Route::get('/profiles/create', [ProfileController::class, 'create'])->name('create-profile');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('store-profile');
    Route::get('/profiles/{profile}', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('update-profile');
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])->name('delete-profile');
    Route::get('/departments', [DepartmentController::class, 'index']);
    Route::post('/departments', [DepartmentController::class, 'store']);
    Route::get('/departments/{department}', [DepartmentController::class, 'show']);
    Route::put('/departments/{department}', [DepartmentController::class, 'update']);
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy']);
 
});
Route::middleware(['auth:sanctum', 'checkRole:Moderator'])->group(function () {

    Route::get('/departments', [DepartmentController::class, 'index']);
    Route::post('/departments', [DepartmentController::class, 'store']);
    Route::get('/departments/{department}', [DepartmentController::class, 'show']);
    Route::put('/departments/{department}', [DepartmentController::class, 'update']);

 
 
    // Routes that require the 'admin' or 'moderator' role
    
  
});
Route::middleware(['auth:sanctum', 'checkRole:Employee'])->group(function () {
    // Routes that require the 'admin' or 'moderator' role
  

 
});
Route::apiResource('roles', RoleController::class);

// Role Routes


// Authentication Routes
Route::post('/auth/login', [AuthController::class, 'loginUser']); // Endpoint for user login
Route::post('/auth/register', [AuthController::class, 'createUser']); // Endpoint for user registration
