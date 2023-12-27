<?php

namespace App\Repositories\ModelRepositories;

use App\Models\Leaverequest;
use App\Models\Leaverequest as ModelsLeaverequest;
use App\Models\Payroll;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class LeaverequestRepository extends BaseRepository
{
    public function __construct(Leaverequest $leaveRequestequest)
    {
        parent::__construct($leaveRequestequest);
    }

    public function leaverequests()
    {
        return "leaverequests";
    }
}
