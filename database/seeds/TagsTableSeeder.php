<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeStep = \Carbon\Carbon::now();

        Tag::create([
            'tag_name' => 'Development',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
        Tag::create([
            'tag_name' => 'Web',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
        Tag::create([
            'tag_name' => 'UI/UX',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
        Tag::create([
            'tag_name' => 'Lifestyle',
            'created_at' => $timeStep,
            'updated_at' => $timeStep,
        ]);
    }
}
