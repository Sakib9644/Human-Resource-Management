<?php

namespace App\Repositories\ModelRepositories;

use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;

class PositionRepository extends BaseRepository
{
    public function __construct(Position $position)
    {
        parent::__construct( $position);
    }

    public function positions()
    {
        return "positions";
    }
}
