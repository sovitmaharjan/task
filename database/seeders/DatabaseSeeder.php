<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('P@ssw0rd'),
            'phone' => '1234567890',
            'dob' => '1992-01-01',
            'gender' => 'm',
            'address' => 'address 1',
            'email_verified_at' => now(),
        ]);
    }
}
