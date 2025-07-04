<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $kontributorRole = Role::create(['name' => 'kontributor']);

        // Create permissions
        $permissions = [
            // Post permissions
            'create posts',
            'edit own posts',
            'edit all posts',
            'delete own posts',
            'delete all posts',
            'view posts',
            
            // Category permissions
            'create categories',
            'edit categories',
            'delete categories',
            'view categories',
            
            // Page permissions
            'create pages',
            'edit pages',
            'delete pages',
            'view pages',
            
            // User permissions
            'create users',
            'edit users',
            'delete users',
            'view users',
            
            // Admin access
            'access admin',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to Super Admin (all permissions)
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign permissions to Kontributor (limited permissions)
        $kontributorRole->givePermissionTo([
            'create posts',
            'edit own posts',
            'delete own posts',
            'view posts',
            'view categories',
            'access admin',
        ]);
    }
}
