<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use SPS\Role;

use SPS\MedicalSubstance;

use SPS\MeasurementUnit;

class PatientPrescriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Deleting all previous data
        //DB::table('patient_prescriptions')->delete();

        // Getting all patients
        $patients = Role::where('name', '=', config('roles.name.patient'))->first()->users()->get();

        // Getting all doctors
        $doctors = Role::where('name', '=', config('roles.name.doctor'))->first()->users()->get();

        // Getting all medical substances
        $medicalSubstances = MedicalSubstance::all();

        // Getting all measurement units
        $measurementUnits = MeasurementUnit::all();

        // Preparing array
        $prescriptions = array();

        // For each patient, giving random doctor
        foreach ($patients as $patient)
        {
            array_push($prescriptions, [
                'patient_id' => $patient->id,
                'doctor_id' => $doctors->random()->id,
                'medical_substance_id' => $medicalSubstances->random()->id,
                'substance_in_dose' => mt_rand(10*2, 100*2)/2,
                'measurement_unit_id' => $measurementUnits->random()->id,
                'description' => $faker->sentence,
                'expires_at' => $faker->dateTimeThisMonth,
            ]);
        }

        // Inserting records
        DB::table('patient_prescriptions')->insert($prescriptions);
    }
}
