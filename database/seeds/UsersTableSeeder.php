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

        for ($i = 0; $i <  10; $i++) {
            User::create([
                'username' => $faker->userName,
                'role_id' => 3,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => $faker->password,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
            ]);
        }

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
    }
}
