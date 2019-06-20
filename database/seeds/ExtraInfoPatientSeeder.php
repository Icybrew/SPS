<?php

use Illuminate\Database\Seeder;

use SPS\Role;

class ExtraInfoPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleting all previous data
        //DB::table('extra_info_patient')->delete();

        // Getting all patients
        $patients = Role::where('name', '=', config('roles.name.patient'))->first()->users()->get();

        // Preparing array
        $extraInfoPatient = array();

        // Inserting fake patient data for each patient
        foreach ($patients as $patient)
        {
            array_push($extraInfoPatient, [
                'patient_id' => $patient->id,
                'ssn' => rand(10000000000, 99999999999),
            ]);
        }

        // Inserting records
        DB::table('extra_info_patient')->insert($extraInfoPatient);
    }
}
