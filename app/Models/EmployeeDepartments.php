<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepartments extends Model
{
    use HasFactory;
    protected $table = 'employeedepartments'; // Specify the actual table name

    protected $fillable = ['employee_id', 'department_id', 'description'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Employee_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
