<?php

namespace Database\Seeders;

use App\Models\Notifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notifikasi::create([
            'id' => 1,
            'isi' => fake()->sentence(),
            'id_petani' => 1,
            'id_pemerintah' => 1
        ]);
        Notifikasi::create([
            'id' => 2,
            'isi' => fake()->sentence(),
            'id_petani' => 1,
            'id_pemerintah' => 1
        ]);
        Notifikasi::create([
            'id' => 3,
            'isi' => fake()->sentence(),
            'id_kios_resmi' => 2,
            'id_pemerintah' => 1
        ]);
    }
}
