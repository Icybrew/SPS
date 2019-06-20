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

        // Roles
        $this->call(RolesSeeder::class);

        // User roles
        $this->call(UserRolesSeeder::class);

        // Specializations
        $this->call(SpecializationsSeeder::class);

        // Measurement units
        $this->call(MeasurementUnitsSeeder::class);
    }
}
