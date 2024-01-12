<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees'; // Specify the actual table name
    protected $fillable = [
        'name', 
        'email', 
        'image', 
        'phone',
        'address', 
        'dob', 
        'gender', 
        'marital_status', 
        'hire_date', 
        'termination_date', 
        'status', 
        'department_id', 
        'position_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
{
    return $this->belongsTo(Department::class, 'department_id');
}
}

