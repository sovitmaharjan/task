<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MusicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Music::factory(500)->create();
    }
}
