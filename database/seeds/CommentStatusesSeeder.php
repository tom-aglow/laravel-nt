<?php

use Illuminate\Database\Seeder;
use App\Models\CommentStatus;

class CommentStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentStatus::create([
            'status' => 'on moderation',
        ]);
        CommentStatus::create([
            'status' => 'accepted',
        ]);
        CommentStatus::create([
            'status' => 'deleted',
        ]);
    }
}
