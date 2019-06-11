<?php

namespace SPS\Policies;

use SPS\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \SPS\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasRole(config('roles.name.admin'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($user->hasRole(config('roles.name.admin'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return FALSE;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        if ($user->hasRole(config('roles.name.admin'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return FALSE;
    }

}
