<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
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
            DB::table('articles')->insert([
                'author' => $faker->name,
                'title' => $faker->unique()->sentence(6),
                'content' => $faker->realText(1000),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
            ]);
        }
    }
}
