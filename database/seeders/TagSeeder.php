<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::updateOrCreate(['user_id' => '1','title' => 'News','slug' => 'news','type' => 'service','description' => Null,'status' => true]);
        Tag::updateOrCreate(['user_id' => '1','title' => 'Magazine','slug' => 'magazine','type' => 'service','description' => Null,'status' => true]);
        Tag::updateOrCreate(['user_id' => '1','title' => 'Blog','slug' => 'blog','type' => 'service','description' => Null,'status' => true]);
        Tag::updateOrCreate(['user_id' => '1','title' => 'Post','slug' => 'post','type' => 'service','description' => Null,'status' => true]);
    }
}
