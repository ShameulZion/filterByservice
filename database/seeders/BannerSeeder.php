<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::updateOrCreate([
            'user_id' => '1',
            'banner_name' => 'Concurrent Events',
            'status' => true,
            'deletable' => false
        ]);
        Banner::updateOrCreate([
            'user_id' => '1',
            'banner_name' => 'Our Partners',
            'status' => true,
            'deletable' => false
        ]);
        Banner::updateOrCreate([
            'user_id' => '1',
            'banner_name' => 'Our Sponsors',
            'status' => true,
            'deletable' => false
        ]);
    }
}
