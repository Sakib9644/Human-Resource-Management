<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'title',
        'description',
        'salary',
    ];

    // Add any additional model-related functionality here
}
