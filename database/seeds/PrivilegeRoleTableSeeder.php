<?php

use Illuminate\Database\Seeder;

class PrivilegeRoleTableSeeder extends Seeder
{
    /*
     * Privileges for all except admin
     */
    protected $rolePrivilege = [
        // moderator
        ['role' => 2, 'privilege' => 5],
        ['role' => 2, 'privilege' => 6],
        ['role' => 2, 'privilege' => 7],

        // user
        ['role' => 3, 'privilege' => 6],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Privileges for admin
         */
        for ($i = 1; $i <= 16; $i++) {
            DB::table('privilege_role')->insert([
                'role_id' => 1,
                'privilege_id' => $i,
            ]);
        }

        foreach ($this->rolePrivilege as $row)
            DB::table('privilege_role')->insert([
                'role_id' => $row['role'],
                'privilege_id' => $row['privilege'],
            ]);
    }
}
