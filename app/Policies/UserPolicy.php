<?php

namespace SPS\Policies;

use SPS\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    function viewMedicalHistory(User $user, User $patient)
    {
        if ($user->isAdmin() || $user->isDoctor() || ($user->id == $patient->id && $user->isPatient())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewPrescriptions(User $user, User $patient)
    {
        if ($user->isAdmin() || $user->isDoctor() || $user->isPharmacist() || ($user->id == $patient->id && $user->isPatient())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function viewPatients(User $user)
    {
        if ($user->isAdmin() || $user->isDoctor()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if($user->isAdmin() || ($user->isDoctor() && $model->isPatient()) || ($user->isPharmacist() && $model->isPatient()) || ($user->id == $model->id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \SPS\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
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
        if ($user->isAdmin() || ($user->id == $model->id)) {
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
        if ($user->isAdmin()) {
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
