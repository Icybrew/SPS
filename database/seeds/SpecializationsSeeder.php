<?php

use Illuminate\Database\Seeder;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();

        $specializations = array(
            array(
                'name' => "Allergist/Immunologist"
            ),
            array(
                'name' => "Cardiologist"
            ),
            array(
                'name' => "Dermatologist"
            ),
            array(
                'name' => "Family Physician"
            ),
            array(
                'name' => "Gastroenterologist"
            ),
            array(
                'name' => "Hematologist"
            ),
            array(
                'name' => "Neurologist"
            ),
        );

        DB::table('specializations')->insert($specializations);

    }
}
