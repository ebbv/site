<?php

/**
 * Message Policy
 *
 * @author Robert Doucette <rice8204@gmail.com>
*/

namespace App\Policies;

use App\Models\Member;
use App\Models\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function view(Member $member, Message $message)
    {
        //
    }

    /**
     * Determine whether the user can create messages.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\Models\Member  $member
     * @return bool
     */
    public function create(Member $member)
    {
        return Member::has('admin')->find($member->id);
    }

    /**
     * Determine whether the user can update the message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Message  $message
     * @return bool
     */
    public function update(Member $member, Message $message)
    {
        return Member::has('admin')->find($member->id);
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\Models\Member  $member
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function delete(Member $member, Message $message)
    {
        //
    }
}
