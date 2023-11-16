<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'image',
        'phone',
        'address',
        'dob',
    ];

    public function profile(){
        return $this->belongsTo(User::class);
    }
}
