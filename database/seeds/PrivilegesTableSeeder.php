<?php

use Illuminate\Database\Seeder;
use App\Models\Privilege;

class PrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // articles
        Privilege::create([
            'name' => 'blog.article.view',
        ]);
        Privilege::create([
            'name' => 'blog.article.add',
        ]);
        Privilege::create([
            'name' => 'blog.article.edit',
        ]);
        Privilege::create([
            'name' => 'blog.article.delete',
        ]);

        // comments
        Privilege::create([
            'name' => 'blog.comment.view',
        ]);
        Privilege::create([
            'name' => 'blog.comment.add',
        ]);
        Privilege::create([
            'name' => 'blog.comment.moderate',
        ]);
        Privilege::create([
            'name' => 'blog.comment.delete',
        ]);

        // tags
        Privilege::create([
            'name' => 'blog.tag.view',
        ]);
        Privilege::create([
            'name' => 'blog.tag.add',
        ]);
        Privilege::create([
            'name' => 'blog.tag.edit',
        ]);
        Privilege::create([
            'name' => 'blog.tag.delete',
        ]);

        // users
        Privilege::create([
            'name' => 'blog.user.view',
        ]);
        Privilege::create([
            'name' => 'blog.user.add',
        ]);
        Privilege::create([
            'name' => 'blog.user.edit',
        ]);
        Privilege::create([
            'name' => 'blog.user.delete',
        ]);
    }
}
