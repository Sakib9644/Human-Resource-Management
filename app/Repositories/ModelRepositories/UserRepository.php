<?php

namespace App\Repositories\ModelRepositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function test()
    {
        return "test";
    }
}
