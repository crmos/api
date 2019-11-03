<?php

namespace Crmos\Authentication\Repositories;

use Crmos\Foundation\Repositories\Repository;
use Crmos\Authentication\Contracts\User as UserRepoContract;
use Crmos\Authentication\Models\User;

class UserRepository extends Repository implements UserRepoContract
{
    function __construct(User $model)
    {
        parent::__construct($model);
    }
}
