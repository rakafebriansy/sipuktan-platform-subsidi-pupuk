<?php

namespace Database\Seeders;

use App\Models\Keluhan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeluhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keluhan::insert([
            'id' => 1,
            'keluhan' => fake()->sentence(),
            'balasan' => fake()->sentence(),
            'tanggal_keluhan' => fake()->date(),
            'id_petani' => 1
        ]);
        Keluhan::insert([
            'id' => 1,
            'keluhan' => fake()->sentence(),
            'balasan' => fake()->sentence(),
            'tanggal_keluhan' => fake()->date(),
            'id_petani' => 2
        ]);
        Keluhan::insert([
            'id' => 1,
            'keluhan' => fake()->sentence(),
            'balasan' => fake()->sentence(),
            'tanggal_keluhan' => fake()->date(),
            'id_kios_resmi' => 1,
        ]);
    }
}
