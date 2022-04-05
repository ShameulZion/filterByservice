<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate([
            'user_id'       => '1',
            'department_id' => '1',
            'title'         => 'Theme',
            'slug'          => 'theme',
            'type'          => 'service',
            'parent_id'     => '0',
            'description'   => Null,
            'status'        => true,
            'image'         => 'theme.png',
        ]);
        Category::updateOrCreate([
            'user_id'       => '1',
            'department_id' => '1',
            'title'         => 'Plugin',
            'slug'          => 'plugin',
            'type'          => 'service',
            'parent_id'     => '0',
            'description'   => Null,
            'status'        => true,
            'image'         => 'plugin.png',
        ]);
        Category::updateOrCreate([
            'user_id'       => '1',
            'department_id' => '1',
            'title'         => 'Template Kits',
            'slug'          => 'template-kits',
            'type'          => 'service',
            'parent_id'     => '0',
            'description'   => Null,
            'status'        => true,
            'image'         => 'template-kits.png',
        ]);
        Category::updateOrCreate([
            'user_id'       => '1',
            'department_id' => '2',
            'title'         => 'Email Templates',
            'slug'          => 'email-templates',
            'type'          => 'service',
            'parent_id'     => '0',
            'description'   => Null,
            'status'        => true,
            'image'         => 'email-templates.png',
        ]);
        Category::updateOrCreate([
            'user_id'       => '1',
            'department_id' => '2',
            'title'         => 'Site Templates',
            'slug'          => 'site-templates',
            'type'          => 'service',
            'parent_id'     => '0',
            'description'   => Null,
            'status'        => true,
            'image'         => 'site-templates.png',
        ]);
        Category::updateOrCreate([
            'user_id'       => '1',
            'department_id' => '2',
            'title'         => 'Landing Page Templates',
            'slug'          => 'landing-page-templates',
            'type'          => 'service',
            'parent_id'     => '0',
            'description'   => Null,
            'status'        => true,
            'image'         => 'landing-page-templates.png',
        ]);
        
        Category::updateOrCreate([
            'user_id'       => '1',
            'department_id' => '2',
            'title'         => 'Admin Template',
            'slug'          => 'admin-template',
            'type'          => 'service',
            'parent_id'     => '0',
            'description'   => Null,
            'status'        => true,
            'image'         => 'admin-template.png',
        ]);
    }
}
