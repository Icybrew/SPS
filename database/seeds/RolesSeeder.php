<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = array(
            array(
                'name' => config('roles.name.admin')
            ),
            array(
                'name' => config('roles.name.doctor')
            ),
            array(
                'name' => config('roles.name.patient')
            ),
            array(
                'name' => config('roles.name.pharmacist')
            ),
        );

        DB::table('roles')->insert($roles);

    }
}
