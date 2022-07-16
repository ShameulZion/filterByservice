<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dashboard
        $moduleAdminDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'admin.dashboard',
        ]);

        // Role management
        $moduleAdminRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Access Roles',
            'slug' => 'admin.role.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Create Role',
            'slug' => 'admin.role.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Edit Role',
            'slug' => 'admin.role.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Delete Role',
            'slug' => 'admin.role.destroy',
        ]);

        // User management
        $moduleAdminUser = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Access Users',
            'slug' => 'admin.user.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Create User',
            'slug' => 'admin.user.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Edit User',
            'slug' => 'admin.user.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Delete User',
            'slug' => 'admin.user.destroy',
        ]);

        // News management
        $moduleAdminNews = Module::updateOrCreate(['name' => 'News Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminNews->id,
            'name' => 'Access News',
            'slug' => 'admin.news.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminNews->id,
            'name' => 'Create News',
            'slug' => 'admin.news.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminNews->id,
            'name' => 'Edit News',
            'slug' => 'admin.news.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminNews->id,
            'name' => 'Delete News',
            'slug' => 'admin.news.destroy',
        ]);

        // Event management
        $moduleAdminEvent = Module::updateOrCreate(['name' => 'Events Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminEvent->id,
            'name' => 'Access Events',
            'slug' => 'admin.event.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminEvent->id,
            'name' => 'Create Events',
            'slug' => 'admin.event.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminEvent->id,
            'name' => 'Edit Events',
            'slug' => 'admin.event.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminEvent->id,
            'name' => 'Delete Events',
            'slug' => 'admin.event.destroy',
        ]);

        
        // Testimonial management
        $moduleAdminTestimonial = Module::updateOrCreate(['name' => 'Testimonial Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminTestimonial->id,
            'name' => 'Access Testimonials',
            'slug' => 'admin.testimonial.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminTestimonial->id,
            'name' => 'Create Testimonial',
            'slug' => 'admin.testimonial.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminTestimonial->id,
            'name' => 'Edit Testimonial',
            'slug' => 'admin.testimonial.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminTestimonial->id,
            'name' => 'Delete Testimonial',
            'slug' => 'admin.testimonial.destroy',
        ]);

        
        // Speaker management
        $moduleAdminSpeaker = Module::updateOrCreate(['name' => 'Speaker Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminSpeaker->id,
            'name' => 'Access Speakers',
            'slug' => 'admin.speaker.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminSpeaker->id,
            'name' => 'Create Speaker',
            'slug' => 'admin.speaker.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminSpeaker->id,
            'name' => 'Edit Speaker',
            'slug' => 'admin.speaker.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminSpeaker->id,
            'name' => 'Delete Speaker',
            'slug' => 'admin.speaker.destroy',
        ]);

        
        // Banner management
        $moduleAdminBanner = Module::updateOrCreate(['name' => 'Banner Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBanner->id,
            'name' => 'Access Banner',
            'slug' => 'admin.banner.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBanner->id,
            'name' => 'Create Banner',
            'slug' => 'admin.banner.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBanner->id,
            'name' => 'Edit Banner',
            'slug' => 'admin.banner.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBanner->id,
            'name' => 'Delete Banner',
            'slug' => 'admin.banner.destroy',
        ]);
    }
}
