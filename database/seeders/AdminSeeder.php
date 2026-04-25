<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'gardenofpam@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'gardenofpam@gmail.com',
                'password' => Hash::make('Calmerthanthewater021300'),
                'role' => 'admin',
            ]
        );
    }
}
