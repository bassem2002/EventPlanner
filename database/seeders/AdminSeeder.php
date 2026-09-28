<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserBw;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            UserBw::firstOrCreate(
                ['email' => 'admin@EventPlaner.com'],
                [
                    'name' => 'Admin',
                    'password' => Hash::make('password123'),
                    'role' => 'admin',
                ]
            );
    }
}
