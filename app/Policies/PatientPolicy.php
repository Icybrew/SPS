<?php

namespace SPS\Policies;

use SPS\User;
use SPS\Patient;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    public function search(User $user)
    {
        if ($user->isAdmin() || $user->isDoctor() || $user->isPharmacist()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can view the patient.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\Patient  $patient
     * @return mixed
     */
    public function view(User $user, Patient $patient)
    {
        //
    }

    /**
     * Determine whether the user can create patients.
     *
     * @param  \SPS\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the patient.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\Patient  $patient
     * @return mixed
     */
    public function update(User $user, Patient $patient)
    {
        //
    }

    /**
     * Determine whether the user can delete the patient.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\Patient  $patient
     * @return mixed
     */
    public function delete(User $user, Patient $patient)
    {
        //
    }

    /**
     * Determine whether the user can restore the patient.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\Patient  $patient
     * @return mixed
     */
    public function restore(User $user, Patient $patient)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the patient.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\Patient  $patient
     * @return mixed
     */
    public function forceDelete(User $user, Patient $patient)
    {
        //
    }
}
