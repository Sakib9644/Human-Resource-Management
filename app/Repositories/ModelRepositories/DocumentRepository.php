<?php

namespace App\Repositories\ModelRepositories;

use App\Http\Controllers\LeaveRequest;
use App\Models\Document;
use App\Models\EmployeeDepartments;
use App\Models\Payroll;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class DocumentRepository extends BaseRepository
{
    public function __construct(Document $documents)
    {
        parent::__construct($documents);
    }

    public function documents()
    {
        return "documents";
    }
}
