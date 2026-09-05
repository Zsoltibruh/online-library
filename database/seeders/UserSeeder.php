<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'name' => 'test',
                'email' => 'test@gmail.com',
                'password' => 'test1234',
            ]);

        User::factory()
            ->create([
                'name' => 'librarian',
                'email' => 'librarian@gmail.com',
                'password' => 'test1234',
                'role' => UserRole::Librarian,
            ]);

        User::factory()
            ->count(20)
            ->create();
    }
}
