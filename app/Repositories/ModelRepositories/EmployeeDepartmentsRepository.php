<?php

namespace App\Repositories\ModelRepositories;

use App\Http\Controllers\LeaveRequest;
use App\Models\EmployeeDepartments;
use App\Models\Payroll;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class EmployeeDepartmentsRepository extends BaseRepository
{
    public function __construct(EmployeeDepartments $employeedepartments)
    {
        parent::__construct($employeedepartments);
    }

    public function employeedepartments()
    {
        return "employeedepartments";
    }
}
