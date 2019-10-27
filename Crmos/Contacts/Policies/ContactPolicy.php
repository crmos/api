<?php

namespace Crmos\Contacts\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Crmos\Contacts\Models\Contact;
use Crmos\People\Models\User;

class ContactPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->can('contact_read');
    }

    public function create(User $user)
    {
        return $user->can('contact_create');
    }

    public function view(User $user, Contact $contact)
    {
        return $user->can('contact_read');
    }

    public function update(User $user, Contact $contact)
    {
        return $user->can('contact_update');
    }

    public function delete(User $user, Contact $contact)
    {
        return $user->can('contact_destroy');
    }
}
