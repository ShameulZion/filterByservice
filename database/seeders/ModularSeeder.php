<?php

namespace Database\Seeders;

use App\Models\Modular;
use Illuminate\Database\Seeder;

class ModularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modular::updateOrCreate([
            'name' => 'Banner',
            'code' => 'Banner',
            'setting' => 'NULL',
        ]);
        Modular::updateOrCreate([
            'name' => 'Slideshow',
            'code' => 'slideshow',
            'setting' => 'NULL',
        ]);
        Modular::updateOrCreate([
            'name' => 'Exhibitors',
            'code' => 'exhibitors',
            'setting' => 'NULL',
        ]);
        Modular::updateOrCreate([
            'name' => 'Speaker',
            'code' => 'speaker',
            'setting' => 'NULL',
        ]);
        Modular::updateOrCreate([
            'name' => 'Testimonials',
            'code' => 'testimonials',
            'setting' => 'NULL',
        ]);
    }
}
