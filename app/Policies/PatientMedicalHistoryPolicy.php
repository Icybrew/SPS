<?php

namespace SPS\Policies;

use SPS\User;
use SPS\PatientMedicalHistory;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientMedicalHistoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the patient medical history.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientMedicalHistory  $patientMedicalHistory
     * @return mixed
     */
    public function view(User $user, PatientMedicalHistory $patientMedicalHistory)
    {
        if ($user->isAdmin() || $user->isDoctor() || ($user->id == $patientMedicalHistory->patient_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can create patient medical histories.
     *
     * @param  \SPS\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isDoctor()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can update the patient medical history.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientMedicalHistory  $patientMedicalHistory
     * @return mixed
     */
    public function update(User $user, PatientMedicalHistory $patientMedicalHistory)
    {
        if ($user->isAdmin() || ($user->id == $patientMedicalHistory->doctor_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can delete the patient medical history.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientMedicalHistory  $patientMedicalHistory
     * @return mixed
     */
    public function delete(User $user, PatientMedicalHistory $patientMedicalHistory)
    {
        if ($user->isAdmin() || ($user->id == $patientMedicalHistory->doctor_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can restore the patient medical history.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientMedicalHistory  $patientMedicalHistory
     * @return mixed
     */
    public function restore(User $user, PatientMedicalHistory $patientMedicalHistory)
    {
        if ($user->isAdmin() || ($user->id == $patientMedicalHistory->doctor_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can permanently delete the patient medical history.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientMedicalHistory  $patientMedicalHistory
     * @return mixed
     */
    public function forceDelete(User $user, PatientMedicalHistory $patientMedicalHistory)
    {
        if ($user->isAdmin()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
