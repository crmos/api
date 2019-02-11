<?php
/**
 * Created by PhpStorm.
 * User: Saurav KC
 */

namespace App\Modules\Authentication\Role\Repositories;

use App\Models\Auth\Role;
use App\Modules\Framework\RepositoryImplementation;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Logging\Log;

class EloquentRoleRepository extends RepositoryImplementation implements  RoleRepository
{
    protected $entity_name = "Role";

    /**
     * Gets model for operation.
     *
     * @return mixed
     */
    public function getModel()
    {
        return new Role();
    }


}

