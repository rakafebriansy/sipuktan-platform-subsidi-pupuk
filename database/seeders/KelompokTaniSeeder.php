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
        KelompokTani::insert([
            'id' => 1,
            'nama' => 'Poktan Sumbersari 1',
            'id_kios_resmi' => 1,
        ]);
        KelompokTani::insert([
            'id' => 2,
            'nama' => 'Poktan Kebonsari 1',
            'id_kios_resmi' => 2,
        ]);
        KelompokTani::insert([
            'id' => 3,
            'nama' => 'Poktan Jayabaya',
            'id_kios_resmi' => 3,
        ]);
    }
}
