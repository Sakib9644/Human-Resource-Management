<?php

namespace App\Repositories\ModelRepositories;

use App\Models\Payroll;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class PayrollRepository extends BaseRepository
{
    public function __construct(Payroll $payroll)
    {
        parent::__construct($payroll);
    }

    public function payrolls()
    {
        return "payrolls";
    }
}
