<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Disable FKs to allow truncation during seeding
        Schema::disableForeignKeyConstraints();

    $this->call(RolesTableSeeder::class);
    $this->call(UsersTableSeeder::class);
    $this->call(AdminSeeder::class);

        // Re-enable FKs after seeding
        Schema::enableForeignKeyConstraints();

    }
}
