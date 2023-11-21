<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ModeratorController;
use App\Http\Controllers\Api\PayrollController;
use App\Http\Controllers\Api\PositionController;
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






// Authentication Routes
// Endpoint for user login
Route::post('/auth/register', [AuthController::class, 'createUser']); // Endpoint for user registration
Route::post('/auth/login', [AuthController::class, 'LoginUser']); // Endpoint for user registration

Route::apiResource('roles', RoleController::class);

// Group for authentication middleware
Route::middleware(['auth:sanctum'])->group(function () {
    // Profiles Routes
    Route::get('/profiles', [ProfileController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/profiles/create', [ProfileController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/profiles', [ProfileController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // Departments Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/departments/create', [DepartmentController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/departments', [DepartmentController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/departments/{department}', [DepartmentController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/departments/{department}', [DepartmentController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // Positions Routes
    Route::get('/positions', [PositionController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/positions/create', [PositionController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/positions', [PositionController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/positions/{position}', [PositionController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/positions/{position}', [PositionController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->middleware(['checkRole:Admin']);

    Route::get('/payrolls', [PayrollController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/payrolls/create', [PayrollController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/payrolls', [PayrollController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/payrolls/{payroll}', [PayrollController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/payrolls/{payroll}', [PayrollController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/payrolls/{payroll}', [PayrollController::class, 'destroy'])->middleware(['checkRole:Admin']);
});
