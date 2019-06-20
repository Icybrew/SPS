<?php

use Illuminate\Database\Seeder;

use SPS\Role;
use SPS\Specialization;

class ExtraInfoDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleting all previous data
        //DB::table('extra_info_doctor')->delete();

        // Getting all doctors
        $doctors = Role::where('name', '=', config('roles.name.doctor'))->first()->users()->get();

        // Getting all available specializations
        $specializations = Specialization::all();
        
        // Preparing array
        $extraInfoDoctor = array();

        // Inserting fake doctor data for each doctor
        foreach ($doctors as $doctor)
        {
            array_push($extraInfoDoctor, [
                'doctor_id' => $doctor->id,
                'specialization_id' => $specializations->random()->id,
            ]);
        }

        // Inserting records
        DB::table('extra_info_doctor')->insert($extraInfoDoctor);
    }
}
