<?php

namespace SPS\Policies;

use SPS\User;
use SPS\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user role.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\UserRole  $userRole
     * @return mixed
     */
    public function view(User $user, UserRole $userRole)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create user roles.
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
     * Determine whether the user can update the user role.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\UserRole  $userRole
     * @return mixed
     */
    public function update(User $user, UserRole $userRole)
    {
        if ($user->hasRole(config('roles.name.admin'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can delete the user role.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\UserRole  $userRole
     * @return mixed
     */
    public function delete(User $user, UserRole $userRole)
    {
        if ($user->hasRole(config('roles.name.admin'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can restore the user role.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\UserRole  $userRole
     * @return mixed
     */
    public function restore(User $user, UserRole $userRole)
    {
        if ($user->hasRole(config('roles.name.admin'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can permanently delete the user role.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\UserRole  $userRole
     * @return mixed
     */
    public function forceDelete(User $user, UserRole $userRole)
    {
        if ($user->hasRole(config('roles.name.admin'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
