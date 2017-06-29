<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeStep = \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s');

        DB::table('tags')->insert([
            'tag_name' => 'Development',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Web',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'UI/UX',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Lifestyle',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
    }
}
