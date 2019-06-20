<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleting all previous data
        //DB::table('users')->delete();

        // Creating fake users via factory
        factory(SPS\User::class, 50)->create();
    }
}
