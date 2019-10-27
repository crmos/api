<?php

namespace Crmos\Acl\Repositories;

use Crmos\Acl\Contracts\Role as RepositoryInterface;
use Crmos\Acl\Models\Role;
use Crmos\Foundation\Repositories\Repository;

class RoleRepository extends Repository implements RepositoryInterface
{
    function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
