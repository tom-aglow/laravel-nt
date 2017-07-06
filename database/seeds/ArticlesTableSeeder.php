<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

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
            Article::create([
                'user_id' => mt_rand(1, 10),
                'image_id' => mt_rand(1, 3),
                'title' => $faker->unique()->sentence(6),
                'subheading' => $faker->unique()->sentence(6),
                'content' => $faker->realText(3000),
                'is_active' => $faker->numberBetween(0, 1),
                'active_from' => $faker->dateTimeBetween('-10 days', 'now'),
                'active_to' => $faker->optional()->dateTimeBetween('-5 days', '+ 10 days'),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
            ]);
        }
    }
}
