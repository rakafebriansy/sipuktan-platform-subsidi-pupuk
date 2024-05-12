<?php

namespace Database\Seeders;

use App\Models\Petani;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([KecamatanSeeder::class, PemilikKiosSeeder::class, KiosResmiSeeder::class, KelompokTaniSeeder::class]);
        Petani::create([
            'id' => 1,
            'nik' => '0025362728812549',
            'nama' => 'Yennefer Vengenberg',
            'kata_sandi' => Hash::make('yenefer@1'),
            'foto_ktp' => 'ktp001.jpg',
            'nomor_telepon' => '081263563732',
            'id_kelompok_tani' => 1
        ]);
        Petani::create([
            'id' => 2,
            'nik' => '0025635728812549',
            'nama' => 'Geralt Rivia',
            'kata_sandi' => Hash::make('geralt@1'),
            'foto_ktp' => 'ktp002.jpg',
            'aktif' => 1,
            'nomor_telepon' => '081233405169',
            'id_kelompok_tani' => 1
        ]);
        Petani::create([
            'id' => 3,
            'nik' => '0025362728811549',
            'nama' => 'Radovid',
            'kata_sandi' => Hash::make('radovid@1'),
            'foto_ktp' => 'ktp003.jpg',
            'nomor_telepon' => '081263563981',
            'id_kelompok_tani' => 2
        ]);
    }
}
