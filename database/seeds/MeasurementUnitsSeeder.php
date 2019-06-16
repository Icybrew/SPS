<?php

use Illuminate\Database\Seeder;

class MeasurementUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurement_units')->delete();

        $units = array(
            array(
                'unit' => 'mg'
            ),
            array(
                'unit' => 'g'
            ),
            array(
                'unit' => 'ml'
            ),
        );

        DB::table('measurement_units')->insert($units);

    }
}
