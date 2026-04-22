<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'your@email.com'],
            [
                'name' => 'Admin',
                'email' => 'gardenofpam@gmail.com',
                'password' => Hash::make('Calmerthanthewater021300'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}