<?php

use Illuminate\Database\Seeder;

class ArticleTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <  10; $i++) {
            DB::table('article_tag')->insert([
                'article_id' => mt_rand(1, 10),
                'tag_id' => mt_rand(1, 4),
            ]);
        }
    }
}
