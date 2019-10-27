<?php

namespace Crmos\People\Repositories;

use Crmos\Foundation\Repositories\Repository;
use Crmos\People\Contracts\User as UserRepoContract;
use Crmos\People\Models\User;

class UserRepository extends Repository implements UserRepoContract
{
    function __construct(User $model)
    {
        parent::__construct($model);
    }
}
