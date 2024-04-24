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
        Alokasi::create([
            'id' => 1,
            'jumlah_pupuk' => 30,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Menunggu Pembayaran',
            'id_jenis_pupuk' => 'urea',
            'id_kios_resmi' => 1,
            'id_petani' => 1
        ]);
        Alokasi::create([
            'id' => 2,
            'jumlah_pupuk' => 60,
            'musim_tanam' => 2,
            'tahun' => 2024,
            'status' => 'Menunggu Pembayaran',
            'id_jenis_pupuk' => 'sp36',
            'id_kios_resmi' => 1,
            'id_petani' => 1
        ]);
        Alokasi::create([
            'id' => 3,
            'jumlah_pupuk' => 60,
            'musim_tanam' => 3,
            'tahun' => 2024,
            'status' => 'Menunggu Pembayaran',
            'id_jenis_pupuk' => 'ponskha',
            'id_kios_resmi' => 1,
            'id_petani' => 1
        ]);
        Alokasi::create([
            'id' => 4,
            'jumlah_pupuk' => 60,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Menunggu Pembayaran',
            'id_jenis_pupuk' => 'urea',
            'id_kios_resmi' => 1,
            'id_petani' => 2
        ]);
        Alokasi::create([
            'id' => 5,
            'jumlah_pupuk' => 60,
            'musim_tanam' => 1,
            'tahun' => 2024,
            'status' => 'Menunggu Pembayaran',
            'id_jenis_pupuk' => 'ponskha',
            'id_kios_resmi' => 1,
            'id_petani' => 2
        ]);
    }
}
