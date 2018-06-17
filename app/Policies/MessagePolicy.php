<?php

/**
 * Message Policy
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Policies;

use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function view(User $user, Message $message)
    {
    }

    /**
     * Determine whether the user can create messages.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->has('admin');
    }

    /**
     * Determine whether the user can update the message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function update(User $user, Message $message)
    {
        return $user->has('admin');
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\User  $user
     * @param  \App\Message  $message
     * @return mixed
     */
    public function delete(User $user, Message $message)
    {
        return $user->has('admin');
    }
}
