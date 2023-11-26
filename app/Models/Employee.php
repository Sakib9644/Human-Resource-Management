<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees'; // Specify the actual table name
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'image',
        'phone',
        'address',
        'dob',
    ];
}
