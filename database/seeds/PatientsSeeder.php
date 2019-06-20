<?php

use Illuminate\Database\Seeder;

use SPS\Role;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleting all previous data
        DB::table('patients')->delete();

        // Getting all patients
        $patients = Role::where('name', '=', config('roles.name.patient'))->first()->users()->get();

        // Getting all doctors
        $doctors = Role::where('name', '=', config('roles.name.doctor'))->first()->users()->get();
        
        // Preparing array
        $doctorPatients = array();

        // For each patient, giving random doctor
        foreach ($patients as $patient)
        {
            array_push($doctorPatients, [
                'patient_id' => $patient->id,
                'doctor_id' => $doctors->random()->id
            ]);
        }

        // Inserting records
        DB::table('patients')->insert($doctorPatients);
    }
}
