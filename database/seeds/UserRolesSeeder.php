<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use SPS\User;
use SPS\Role;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleting all previous data
        DB::table('user_roles')->delete();

        // Getting all users
        $users = User::all();

        // Getting all roles
        $roles = Role::all();
        
        // Preparing array
        $userRoles = array();

        // For each user, giving random role
        foreach ($users as $user)
        {
            array_push($userRoles, [
                'user_id' => $user->id,
                'role_id' => $roles->random()->id
            ]);
        }

        // Inserting records
        DB::table('user_roles')->insert($userRoles);
    }
}
