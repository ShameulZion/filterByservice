<?php

namespace Database\Seeders;

use App\Models\Filter;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filter::updateOrCreate([
            'user_id'       => '1',
            'title'         => 'WordPress',
            'group_name'    => 'WordPress',
            'sort_order'    => '1',
        ]);
    }
}
