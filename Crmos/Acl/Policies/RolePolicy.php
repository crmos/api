<?php

namespace Crmos\Acl\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Crmos\Acl\Models\Role;
use Crmos\Authentication\Models\User;

class RolePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->can('role_read');
    }

    public function create(User $user)
    {
        return $user->can('role_create');
    }

    public function view(User $user, Role $role)
    {
        return $user->can('role_read');
    }

    public function update(User $user, Role $role)
    {
        return $user->can('role_update');
    }

    public function delete(User $user, Role $role)
    {
        return $user->can('role_destroy');
    }
}
