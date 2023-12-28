<?php

// app/Models/Leaverequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaverequest extends Model
{
    protected $table = 'leave_requests';
    protected $fillable = [
        'employee_id',
        'employee_name',
        'employee_email',
        'leave_type',
        'start_date',
        'end_date',
        'status',
        'reason',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
