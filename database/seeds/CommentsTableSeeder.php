<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <  30; $i++) {
            Comment::create([
                'user_id' => mt_rand(1, 3),
                'article_id' => mt_rand(1, 10),
                'user_comment' => $faker->realText(200),
                'status_id' => mt_rand(1, 3),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'),
            ]);
        }
    }
}
