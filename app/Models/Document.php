<?php

// app/Models/Document.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Profiler\Profile;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'document_name',
        'file_path',
        'upload_date',
        'description',
    ];

    // Define the relationship with the Employee model


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
