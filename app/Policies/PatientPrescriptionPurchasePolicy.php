<?php

namespace SPS\Policies;

use SPS\User;
use SPS\PatientPrescriptionPurchase;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPrescriptionPurchasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the patient prescription purchase.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescriptionPurchase  $patientPrescriptionPurchase
     * @return mixed
     */
    public function view(User $user, PatientPrescriptionPurchase $patientPrescriptionPurchase)
    {
        //
    }

    /**
     * Determine whether the user can create patient prescription purchases.
     *
     * @param  \SPS\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin() || $user->isPharmacist()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can update the patient prescription purchase.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescriptionPurchase  $patientPrescriptionPurchase
     * @return mixed
     */
    public function update(User $user, PatientPrescriptionPurchase $patientPrescriptionPurchase)
    {
        //
    }

    /**
     * Determine whether the user can delete the patient prescription purchase.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescriptionPurchase  $patientPrescriptionPurchase
     * @return mixed
     */
    public function delete(User $user, PatientPrescriptionPurchase $patientPrescriptionPurchase)
    {
        //
    }

    /**
     * Determine whether the user can restore the patient prescription purchase.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescriptionPurchase  $patientPrescriptionPurchase
     * @return mixed
     */
    public function restore(User $user, PatientPrescriptionPurchase $patientPrescriptionPurchase)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the patient prescription purchase.
     *
     * @param  \SPS\User  $user
     * @param  \SPS\PatientPrescriptionPurchase  $patientPrescriptionPurchase
     * @return mixed
     */
    public function forceDelete(User $user, PatientPrescriptionPurchase $patientPrescriptionPurchase)
    {
        //
    }
}
