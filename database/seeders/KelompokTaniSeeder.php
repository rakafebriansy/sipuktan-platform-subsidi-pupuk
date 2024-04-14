<?php

namespace Database\Seeders;

use App\Models\KelompokTani;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokTaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([KecamatanSeeder::class, PemilikKiosSeeder::class, KiosResmiSeeder::class]);
        KelompokTani::create([
            'id' => 1,
            'nama' => 'Poktan Sumbersari 1',
            'id_kios_resmi' => 1,
            'id_kecamatan' => 'sumbersari'
        ]);
        KelompokTani::create([
            'id' => 2,
            'nama' => 'Poktan Kebonsari 1',
            'id_kios_resmi' => 2,
            'id_kecamatan' => 'kebonsari'
        ]);
        KelompokTani::create([
            'id' => 3,
            'nama' => 'Poktan Jayabaya',
            'id_kios_resmi' => 3,
            'id_kecamatan' => 'ajung'
        ]);
    }
}
