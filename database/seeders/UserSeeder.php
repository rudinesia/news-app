<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@newsapp.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'email_verified_at' => now(),
        ]);

        // Assign super admin role
        $superAdmin->assignRole('superadmin');

        // Create a sample Kontributor user
        $kontributor = User::create([
            'name' => 'John Kontributor',
            'email' => 'kontributor@newsapp.com',
            'password' => Hash::make('password'),
            'role' => 'kontributor',
            'email_verified_at' => now(),
        ]);

        // Assign kontributor role
        $kontributor->assignRole('kontributor');
    }
}
