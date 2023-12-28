<?php

// app/Models/Attendance.php

namespace App\Models;

use Carbon\Carbon;
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

    public function setClockInTimeAttribute($value)
    {
        $this->attributes['clock_in_time'] = Carbon::createFromFormat('h:iA', $value)->format('H:i');
    }
    
    public function setClockOutTimeAttribute($value)
    {
        $this->attributes['clock_out_time'] = $value ? Carbon::createFromFormat('h:iA', $value)->format('H:i') : null;
    }
    
    
}
