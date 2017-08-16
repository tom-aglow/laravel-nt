<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
            'username' => 'admin',
            'role_id' => 1,
            'name' => 'Tom Admin',
            'email' => 'tom@ohhhh.me',
            'password' => 'qwerty',
            'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
        ]);

        User::create([
            'username' => 'moderator',
            'role_id' => 2,
            'name' => 'Tom Moderator',
            'email' => 'moder@ohhhh.me',
            'password' => 'asdfgh',
            'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
        ]);

        User::create([
            'username' => 'tester',
            'role_id' => 3,
            'name' => 'Guest user',
            'email' => 'guest@ohhhh.me',
            'password' => 'zxcvbn',
            'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
        ]);
    }
}
