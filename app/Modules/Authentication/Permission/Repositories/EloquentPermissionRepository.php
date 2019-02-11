<?php
/**
 * Created by PhpStorm.
 * User: Saurav KC
 */

namespace App\Modules\Authentication\Permission\Repositories;

use App\Models\Auth\Permission;
use App\Modules\Framework\RepositoryImplementation;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Logging\Log;

class EloquentPermissionRepository extends RepositoryImplementation implements  PermissionRepository
{
    protected $entity_name = "Permission";

    /**
     * Gets model for operation.
     *
     * @return mixed
     */
    public function getModel()
    {
        return new Permission();
    }



}

