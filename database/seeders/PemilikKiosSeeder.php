<?php

namespace Database\Seeders;

use App\Models\PemilikKios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PemilikKiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PemilikKios::create([
            'nama_pemilik' => 'Richard Nixon',
            'nik' => 6534112376590876,
            'kata_sandi' => Hash::make('nixon@1'),
            'foto_ktp' => 'ktp004.jpg',
            'nomor_telepon' => '085443678965'
        ]);
        PemilikKios::create([
            'nama_pemilik' => 'Dwight D Eisenhower',
            'nik' => 9865112376590876,
            'kata_sandi' => Hash::make('dwight@1'),
            'foto_ktp' => 'ktp005.jpg',
            'nomor_telepon' => '085973678965'
        ]);
        PemilikKios::create([
            'nama_pemilik' => 'Theodore Roosevelt',
            'nik' => 6534112376590876,
            'kata_sandi' => Hash::make('theodore@1'),
            'foto_ktp' => 'ktp006.jpg',
            'nomor_telepon' => '085443678965'
        ]);
    }
}
