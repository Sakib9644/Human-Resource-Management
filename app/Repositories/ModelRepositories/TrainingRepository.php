<?php

namespace App\Repositories\ModelRepositories;


use App\Models\Training;
use App\Models\User;
use App\Repositories\BaseRepository;

class TrainingRepository extends BaseRepository
{
    public function __construct(Training $training)
    {
        parent::__construct( $training);
    }

    public function trainings()
    {
        return "trainings";
    }
}
