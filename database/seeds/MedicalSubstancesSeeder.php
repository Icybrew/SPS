<?php

use Illuminate\Database\Seeder;

class MedicalSubstancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleting all previous data
        DB::table('medical_substances')->delete();

        $medicalSubstances = array(
            [
                'name' => 'Aspirin'
            ],
            [
                'name' => 'Ibuprofen'
            ],
            [
                'name' => 'Paracetamol'
            ],
            [
                'name' => 'Simvastatin'
            ],
            [
                'name' => 'Levothyroxine sodium'
            ],
            [
                'name' => 'Ramipril'
            ],
            [
                'name' => 'Bendroflumethiazide'
            ],
            [
                'name' => 'Salbutamol'
            ],
            [
                'name' => 'Omeprazole'
            ],
            [
                'name' => 'Lansoprazole'
            ],
            [
                'name' => 'Co-codamol'
            ]
        );

        DB::table('medical_substances')->insert($medicalSubstances);
    }
}
