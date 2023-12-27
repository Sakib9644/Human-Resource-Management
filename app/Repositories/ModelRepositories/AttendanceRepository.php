<?php

namespace App\Repositories\ModelRepositories;

use App\Http\Controllers\LeaveRequest;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\EmployeeDepartments;
use App\Models\Payroll;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class AttendanceRepository extends BaseRepository
{
    public function __construct(Attendance $attendance)
    {
        parent::__construct( $attendance);
    }

    public function attendances()
    {
        return "attendances";
    }
}
