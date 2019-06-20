<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use SPS\Role;

class PatientMedicalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Deleting all previous data
        //DB::table('patient_medical_history')->delete();

        // Getting all patients
        $patients = Role::where('name', '=', config('roles.name.patient'))->first()->users()->get();

        // Getting all doctors
        $doctors = Role::where('name', '=', config('roles.name.doctor'))->first()->users()->get();
        
        // Preparing array
        $medicalHistory = array();

        // For each patient, giving random doctor
        foreach ($patients as $patient)
        {
            array_push($medicalHistory, [
                'patient_id' => $patient->id,
                'doctor_id' => $doctors->random()->id,
                'disease_code' => 'L123-456',
                'description' => $faker->sentence,
                'visit_duration' => rand(30, 180),
                'visit_compensated' => rand(0, 1),
                'visit_repeated' => rand(0, 1),
                'visited_at' => $faker->dateTimeThisYear,
            ]);
        }

        // Inserting records
        DB::table('patient_medical_history')->insert($medicalHistory);
    }
}
