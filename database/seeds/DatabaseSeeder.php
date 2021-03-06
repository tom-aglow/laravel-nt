<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(UploadsTableSeeder::class);
         $this->call(ArticlesTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(ArticleTagTableSeeder::class);
         $this->call(CommentStatusesSeeder::class);
         $this->call(CommentsTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(PrivilegesTableSeeder::class);
         $this->call(PrivilegeRoleTableSeeder::class);
    }
}
