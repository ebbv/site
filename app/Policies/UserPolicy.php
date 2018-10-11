<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create Directory entries.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin;
    }

    /**
     * Determine whether the user can update the Directory entry.
     *
     * @author Robert Doucette <rice8204@gmail>
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $loggedInUser, User $user)
    {
        return $loggedInUser->id === $user->id or $loggedInUser->isAdmin;
    }
}
