<?php

// app/Models/Attendance.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_date',
        'clock_in_time',
        'clock_out_time',
        'status',
    ];

    // Define the relationship with Employee model

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    
}
