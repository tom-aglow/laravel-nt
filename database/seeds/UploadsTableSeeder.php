<?php

use Illuminate\Database\Seeder;
use App\Models\Upload;


class UploadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Upload::create([
            'path' => '0.044.04407a990daf25cae890be4e60c180ed49cf6a52',
            'size' => '1143741',
            'oldname' => '19_JUNI_LIFESTYLE_GMS.jpg',
            'ext' => 'jpg',
            'mime' => 'image/jpeg',
        ]);

        Upload::create([
            'path' => '4.412.4129afcc33d1b38f8d9448ea56c7941fe6c1d7c3',
            'size' => '737887',
            'oldname' => 'DJ-Snake-7.jpg',
            'ext' => 'jpg',
            'mime' => 'image/jpeg',
        ]);

        Upload::create([
            'path' => '2.293.293f39a8bb061b455a8b813f10b887ecc7856bfb',
            'size' => '468468',
            'oldname' => 'mg1.jpg',
            'ext' => 'jpg',
            'mime' => 'image/jpeg',
        ]);
    }
}
