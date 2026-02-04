<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{

    User::factory()->create([
        'name' => 'ABC Admin',
        'email' => 'admin@abccars.com',
        'password' => bcrypt('Admin123!'),
        'role' => 1,
    ]);


    User::factory(5)->create([
        'role' => 0,
    ]);
}
}
