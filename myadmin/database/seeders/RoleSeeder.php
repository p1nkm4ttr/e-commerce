<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Picker', 'slug' => 'picker'],
            ['name' => 'Packer', 'slug' => 'packer'],
            ['name' => 'Rider', 'slug' => 'rider'],
            ['name' => 'Admin', 'slug' => 'admin'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['slug' => $role['slug']], // Check if exists by slug
                ['name' => $role['name']] // Additional data to create if not exists
            );
        }
    }
}