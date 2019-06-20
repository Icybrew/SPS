<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Users
        $this->call(UsersSeeder::class);

        // Extra info patient
        $this->call(ExtraInfoPatientSeeder::class);

        // Extra info doctor
        $this->call(ExtraInfoDoctorSeeder::class);

        // Extra info pharmacist
        $this->call(ExtraInfoPharmacistSeeder::class);

        // Roles
        $this->call(RolesSeeder::class);

        // User roles
        $this->call(UserRolesSeeder::class);

        // Specializations
        $this->call(SpecializationsSeeder::class);

        // Measurement units
        $this->call(MeasurementUnitsSeeder::class);

        // Medical substances
        $this->call(MedicalSubstancesSeeder::class);

    }
}
