<?php

namespace Database\Seeders;

use App\Models\KiosResmi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KiosResmiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KiosResmi::create([
            'id' => 1,
            'nib' => '0908897766',
            'nama' => 'Harapan',
            'jalan'=> 'Jl. Mangga',
            'kata_sandi' => Hash::make('nixon@1'),
            'id_pemilik_kios' => 1,
            'id_kecamatan' => 'sumbersari'
        ]);
        KiosResmi::create([
            'id' => 2,
            'nib' => '9312737498',
            'nama' => 'Tani Jaya',
            'jalan'=> 'Jl. Manggis',
            'kata_sandi' => Hash::make('dwight@1'),
            'id_pemilik_kios' => 2,
            'id_kecamatan' => 'kebonsari'
        ]);
        KiosResmi::create([
            'id' => 3,
            'nib' => '128474710',
            'nama' => 'Makmur Jaya',
            'kata_sandi' => Hash::make('theodore@1'),
            'jalan'=> 'Jl. Veteran',
            'id_pemilik_kios' => 3,
            'id_kecamatan' => 'ajung'
        ]);
    }
}
