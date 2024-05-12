<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kecamatan::insert([
            'id' => 'patrang',
            'nama' => 'Patrang'
        ]);
        Kecamatan::insert([
            'id' => 'sumbersari',
            'nama' => 'Sumbersari'
        ]);
        Kecamatan::insert([
            'id' => 'pakusari',
            'nama' => 'Pakusari'
        ]);
        Kecamatan::insert([
            'id' => 'kebonsari',
            'nama' => 'Kebonsari'
        ]);
        Kecamatan::insert([
            'id' => 'ajung',
            'nama' => 'Ajung'
        ]);
    }
}
