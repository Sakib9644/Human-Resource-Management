<?php

namespace App\Repositories\ModelRepositories;

use App\Http\Controllers\LeaveRequest;
use App\Models\Employee;
use App\Models\EmployeeDepartments;
use App\Models\Payroll;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class EmployeeRepository extends BaseRepository
{
    public function __construct(Employee $employee)
    {
        parent::__construct($employee);
    }

    public function employees()
    {
        return "employees";
    }
}
