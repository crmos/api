<?php
/**
 * Created by PhpStorm.
 * User: Saurav KC
 */

namespace App\Modules\Authentication\User\Repositories;

use App\Models\Auth\User;
use App\Modules\Framework\RepositoryImplementation;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Logging\Log;

class EloquentUserRepository extends RepositoryImplementation implements UserRepository
{
    protected $entity_name = "User";

    /**
     * Gets model for operation.
     *
     * @return mixed
     */
    public function getModel()
    {
        return new User();
    }

    public function getAllForDataTable()
    {
        return $this->getModel()->query()->with(['roles']);
    }

}

