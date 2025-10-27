<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Seed the admins table with a default admin account.
     */
    public function run(): void
    {
        // Create or update a default admin user
        Admin::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Default Admin',
                'password' => Hash::make('admin'),
            ]
        );
    }
}
