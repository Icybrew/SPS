<?php

namespace SPS\Policies;

use SPS\User;
use SPS\PatientPrescription;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPrescriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the patient prescription.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescription  $patientPrescription
     * @return mixed
     */
    public function view(User $user, PatientPrescription $patientPrescription)
    {
        if ($user->isAdmin() || $user->isDoctor() || ($user->id == $patientPrescription->patient_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can create patient prescriptions.
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
     * Determine whether the user can update the patient prescription.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescription  $patientPrescription
     * @return mixed
     */
    public function update(User $user, PatientPrescription $patientPrescription)
    {
        if ($user->isAdmin() || ($user->id == $patientPrescription->doctor_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can delete the patient prescription.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescription  $patientPrescription
     * @return mixed
     */
    public function delete(User $user, PatientPrescription $patientPrescription)
    {
        if ($user->isAdmin() || ($user->id == $patientPrescription->doctor_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can restore the patient prescription.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescription  $patientPrescription
     * @return mixed
     */
    public function restore(User $user, PatientPrescription $patientPrescription)
    {
        if ($user->isAdmin() || ($user->id == $patientPrescription->doctor_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can permanently delete the patient prescription.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescription  $patientPrescription
     * @return mixed
     */
    public function forceDelete(User $user, PatientPrescription $patientPrescription)
    {
        if ($user->isAdmin()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
