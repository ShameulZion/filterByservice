<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::updateOrCreate(['user_id' => '1','title' => 'Wordpress','slug' => 'Wordpress','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Web Templates','slug' => 'web-templates','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Graphic Templates','slug' => 'graphic-templates','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Graphic','slug' => 'graphic','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Music','slug' => 'music','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Presentation Templates','slug' => 'presentation-templates','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Sound Effects','slug' => 'sound-effects','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Stock Video','slug' => 'stock-video','type' => 'service','description' => Null,'status' => true]);
        Department::updateOrCreate(['user_id' => '1','title' => 'Video Templates','slug' => 'video-templates','type' => 'service','description' => Null,'status' => true]);
    }
}
