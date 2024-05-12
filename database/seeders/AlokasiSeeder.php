<?php

namespace Database\Seeders;

use App\Models\Alokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([PemerintahSeeder::class,JenisPupukSeeder::class,PetaniSeeder::class,FaqSeeder::class]);
        Alokasi::insert([
            'id' => 1,
            'jumlah_pupuk' => 1,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Belum Tersedia',
            'id_jenis_pupuk' => 'urea',
            'id_kios_resmi' => 1,
            'id_petani' => 1
        ]);
        Alokasi::insert([
            'id' => 2,
            'jumlah_pupuk' => 2,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Belum Tersedia',
            'id_jenis_pupuk' => 'sp36',
            'id_kios_resmi' => 1,
            'id_petani' => 1
        ]);
        Alokasi::insert([
            'id' => 3,
            'jumlah_pupuk' => 60,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Belum Tersedia',
            'id_jenis_pupuk' => 'ponskha',
            'id_kios_resmi' => 1,
            'id_petani' => 1
        ]);
        Alokasi::insert([
            'id' => 4,
            'jumlah_pupuk' => 1,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Belum Tersedia',
            'id_jenis_pupuk' => 'urea',
            'id_kios_resmi' => 1,
            'id_petani' => 2
        ]);
        Alokasi::insert([
            'id' => 5,
            'jumlah_pupuk' => 1,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Belum Tersedia',
            'id_jenis_pupuk' => 'ponskha',
            'id_kios_resmi' => 1,
            'id_petani' => 2
        ]);
    }
}
