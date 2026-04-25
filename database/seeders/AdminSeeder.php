<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'gardenofpam@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'gardenofpam@gmail.com',
                'password' => 'Calmerthanthewater021300',
                'role' => 'admin',
            ]
        );
    }
}