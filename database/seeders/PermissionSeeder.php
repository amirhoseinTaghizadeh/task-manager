<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


            // Create default permissions using the factory
            factory(Permission::class)->create(['name' => 'manage_users']);
            factory(Permission::class)->create(['name' => 'manage_roles']);
            factory(Permission::class)->create(['name' => 'manage_cards']);
            factory(Permission::class)->create(['name' => 'manage_tasks']);
        
    }
}
