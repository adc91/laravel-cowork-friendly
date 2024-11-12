<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@coworkfriendly.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );
    }
}
