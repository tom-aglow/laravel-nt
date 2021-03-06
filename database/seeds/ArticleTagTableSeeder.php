<?php

use Illuminate\Database\Seeder;

class ArticleTagTableSeeder extends Seeder
{
    protected $articlesTags = [
            ['article' => 1, 'tag' => 1],
            ['article' => 1, 'tag' => 2],
            ['article' => 2, 'tag' => 2],
            ['article' => 2, 'tag' => 3],
            ['article' => 3, 'tag' => 1],
            ['article' => 3, 'tag' => 4],
            ['article' => 4, 'tag' => 2],
            ['article' => 5, 'tag' => 1],
            ['article' => 5, 'tag' => 3],
            ['article' => 5, 'tag' => 4],
            ['article' => 6, 'tag' => 1],
            ['article' => 6, 'tag' => 4],
            ['article' => 7, 'tag' => 3],
            ['article' => 7, 'tag' => 4],
            ['article' => 8, 'tag' => 2],
            ['article' => 8, 'tag' => 3],
            ['article' => 8, 'tag' => 4],
            ['article' => 9, 'tag' => 1],
            ['article' => 9, 'tag' => 4],
            ['article' => 10, 'tag' => 1],
            ['article' => 10, 'tag' => 2],
        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->articlesTags as $row)
            DB::table('article_tag')->insert([
                'article_id' => $row['article'],
                'tag_id' => $row['tag'],
            ]);
    }
}
