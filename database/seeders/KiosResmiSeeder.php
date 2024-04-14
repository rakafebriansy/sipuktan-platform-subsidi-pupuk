<?php

namespace Database\Seeders;

use App\Models\KiosResmi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KiosResmiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KiosResmi::create([
            'id' => 1,
            'nib' => 0908897766,
            'nama' => 'Harapan',
            'jalan'=> 'Jl. Mangga',
            'id_pemilik_kios' => 1,
            'id_kecamatan' => 2
        ]);
        KiosResmi::create([
            'id' => 2,
            'nib' => 9312737498,
            'nama' => 'Tani Jaya',
            'jalan'=> 'Jl. Manggis',
            'id_pemilik_kios' => 2,
            'id_kecamatan' => 4
        ]);
        KiosResmi::create([
            'id' => 1,
            'nib' => 128474710,
            'nama' => 'Makmur Jaya',
            'jalan'=> 'Jl. Veteran',
            'id_pemilik_kios' => 3,
            'id_kecamatan' => 5
        ]);
    }
}
