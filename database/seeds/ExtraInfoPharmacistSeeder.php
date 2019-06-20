<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use SPS\Role;

class ExtraInfoPharmacistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Deleting all previous data
        //DB::table('extra_info_pharmacist')->delete();

        // Getting all pharmacists
        $pharmacists = Role::where('name', '=', config('roles.name.pharmacist'))->first()->users()->get();
        
        // Preparing array
        $extraInfoPharmacist = array();

        // Inserting fake doctor data for each doctor
        foreach ($pharmacists as $pharmacist)
        {
            array_push($extraInfoPharmacist, [
                'pharmacist_id' => $pharmacist->id,
                'workplace' => $faker->companySuffix . ' ' . $faker->company
            ]);
        }

        // Inserting records
        DB::table('extra_info_pharmacist')->insert($extraInfoPharmacist);
    }
}
