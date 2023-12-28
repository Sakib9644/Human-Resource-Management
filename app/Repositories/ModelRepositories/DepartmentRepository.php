<?php

namespace App\Repositories\ModelRepositories;

use App\Http\Controllers\LeaveRequest;
use App\Models\Department;
use App\Models\EmployeeDepartments;
use App\Models\Payroll;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository
{
    public function __construct(Department $department)
    {
        parent::__construct($department);
    }

    public function departments()
    {
        return "departments";
    }
}
