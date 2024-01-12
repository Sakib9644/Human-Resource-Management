<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeDepartmentController;
use App\Http\Controllers\Api\EmployeeDepartmentsController;
use App\Http\Controllers\Api\LeaveRequestController;
use App\Http\Controllers\Api\ModeratorController;
use App\Http\Controllers\Api\PayrollController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TrainingController;
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

Route::post('/auth/register', [AuthController::class, 'createUser']); // Endpoint for user registration
 // Endpoint for user registration
 Route::post('/auth/login', [AuthController::class, 'LoginUser']);

Route::apiResource('roles', RoleController::class);

// Group for authentication middleware
Route::middleware(['auth:sanctum'])->group(function () {

    //Profile Controller
    Route::get('/employees', [EmployeeController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/employees', [EmployeeController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // Departments Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/departments/create', [DepartmentController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/departments', [DepartmentController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/departments/{id}', [DepartmentController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // Positions Routes
    Route::get('/positions', [PositionController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/positions/create', [PositionController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/positions', [PositionController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/positions/{id}', [PositionController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/positions/{id}/edit', [PositionController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/positions/{id}', [PositionController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/positions/{id}', [PositionController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // PayrollController Routes
    Route::get('/payrolls', [PayrollController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/payrolls/create', [PayrollController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/payrolls', [PayrollController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/payrolls/{id}', [PayrollController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/payrolls/{id}/edit', [PayrollController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/payrolls/{id}', [PayrollController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/payrolls/{id}', [PayrollController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // LeaveRequestController Routes
    Route::get('/leaverequests', [LeaveRequestController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/leaverequests/create', [LeaveRequestController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/leaverequests', [LeaveRequestController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/leaverequests/{id}', [LeaveRequestController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/leaverequests/{id}/edit', [LeaveRequestController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/leaverequests/{id}', [LeaveRequestController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/leaverequests/{id}', [LeaveRequestController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // AttendanceController Routes
    Route::get('/attendances', [AttendanceController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/attendances/create', [AttendanceController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/attendances', [AttendanceController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/attendances/{id}', [AttendanceController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/attendances/{id}/edit', [AttendanceController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/attendances/{id}', [AttendanceController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // DocumentController Routes
    Route::get('/documents', [DocumentController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/documents/create', [DocumentController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/documents', [DocumentController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/documents/{id}', [DocumentController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/documents/{id}', [DocumentController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // EmployeeDepartmentsController Routes
    Route::get('/employee-departments', [EmployeeDepartmentsController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/employee-departments/create', [EmployeeDepartmentsController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/employee-departments', [EmployeeDepartmentsController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/employee-departments/{id}', [EmployeeDepartmentsController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/employee-departments/{id}/edit', [EmployeeDepartmentsController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/employee-departments/{id}', [EmployeeDepartmentsController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/employee-departments/{id}', [EmployeeDepartmentsController::class, 'destroy'])->middleware(['checkRole:Admin']);

    // TrainingController Routes
    Route::get('/trainings', [TrainingController::class, 'index'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/trainings/create', [TrainingController::class, 'create'])->middleware(['checkRole:Admin,Moderator']);
    Route::post('/trainings', [TrainingController::class, 'store'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/trainings/{id}', [TrainingController::class, 'show'])->middleware(['checkRole:Admin,Moderator']);
    Route::get('/trainings/{id}/edit', [TrainingController::class, 'edit'])->middleware(['checkRole:Admin,Moderator']);
    Route::put('/trainings/{id}', [TrainingController::class, 'update'])->middleware(['checkRole:Admin,Moderator']);
    Route::delete('/trainings/{id}', [TrainingController::class, 'destroy'])->middleware(['checkRole:Admin']);
});
