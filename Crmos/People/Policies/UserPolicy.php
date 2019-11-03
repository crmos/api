<?php

namespace Crmos\Authentication\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Crmos\Authentication\Models\User;

/**
 * Class UserPolicy
 *
 * @package \Crmos\Authentication
 */
class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->can('user_read');
    }

    public function create(User $user)
    {
        return $user->can('user_create');
    }

    public function view(User $user, User $register)
    {
        return $user->can('user_read') || $user->id == $register->id;
    }

    public function update(User $user, User $register)
    {
        return $user->can('user_update') || $user->id == $register->id;
    }

    public function delete(User $user, User $register)
    {
        return $user->can('user_destroy') || $user->id == $register->id;
    }

}
