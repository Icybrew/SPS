<?php

namespace SPS\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'SPS\User' => 'SPS\Policies\UserPolicy',
        'SPS\UserRole' => 'SPS\Policies\UserRolePolicy',
        'SPS\PatientMedicalHistory' => 'SPS\Policies\PatientmedicalHistoryPolicy',
        'SPS\PatientPrescription' => 'SPS\Policies\PatientPrescriptionPolicy',
        'SPS\PatientPrescriptionPurchase' => 'SPS\Policies\PatientPrescriptionPurchasePolicy',
        'SPS\Patient' => 'SPS\Policies\PatientPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
