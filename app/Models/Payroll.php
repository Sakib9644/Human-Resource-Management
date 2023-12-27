<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'pay_period_start_date',
        'pay_period_end_date',
        'basic_salary',
        'overtime_pay',
        'deductions',
        'net_salary',
    ];

    // Add any additional model-related functionality here

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
