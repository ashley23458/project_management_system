<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'User'],
            ['name' => 'Admin'],
        ];

        DB::table('roles')->insert($roles);
    }
}
