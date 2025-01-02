<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name' => 'Development Team',
            'description' => 'Handles all the development tasks.',
        ]);

        Team::create([
            'name' => 'Design Team',
            'description' => 'Responsible for UI/UX design.',
        ]);
    }
}
