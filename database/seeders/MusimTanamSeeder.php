<?php

namespace Database\Seeders;

use App\Models\MusimTanam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusimTanamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MusimTanam::insert([
            'id' => 1,
            'musim_tanam' => 'MT1',
            'tahun' => 2024
        ]);
    }
}
