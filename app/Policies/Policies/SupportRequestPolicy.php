<?php

namespace App\Policies;

use App\SupportRequest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupportRequestPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the support request.
     *
     * @param  \App\User  $user
     * @param  \App\SupportRequest  $supportRequest
     * @return mixed
     */
    public function view(User $user, SupportRequest $supportRequest)
    {
        return $user->is_manager || $user->id === $supportRequest->user_id;
    }

    /**
     * Determine whether the user can close the support request.
     *
     * @param  \App\User  $user
     * @param  \App\SupportRequest  $supportRequest
     * @return mixed
     */
    public function close(User $user, SupportRequest $supportRequest)
    {
        return $user->id === $supportRequest->user_id;
    }



    /**
     * Determine whether the user can update the support request.
     *
     * @param  \App\User  $user
     * @param  \App\SupportRequest  $supportRequest
     * @return mixed
     */
    public function update(User $user, SupportRequest $supportRequest)
    {
        return $user->id === $supportRequest->user_id;
    }

    /**
     * Determine whether the user can delete the support request.
     *
     * @param  \App\User  $user
     * @param  \App\SupportRequest  $supportRequest
     * @return mixed
     */
    public function delete(User $user, SupportRequest $supportRequest)
    {
        return $user->is_manager;
    }


}
