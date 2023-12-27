<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Profile;
use Spatie\Permission\Traits\HasRoles;





class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }
    
    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
    public function attendence()
    {
        return $this->hasMany(Attendance::class);
    }
    public function department()
    {
        return $this->hasMany(Department::class);
    }
    public function document()
    {
        return $this->hasMany(Document::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function payroll()
    {
        return $this->hasMany(Payroll::class);
    }
    public function position()
    {
        return $this->hasMany(Position::class);
    }
    public function employee_departments()
    {
        return $this->hasMany(EmployeeDepartments::class);
    }
  
}
