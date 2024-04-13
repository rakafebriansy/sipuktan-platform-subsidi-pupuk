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
        Kecamatan::create([
            'id' => 'patrang',
            'nama' => 'Patrang'
        ]);
        Kecamatan::create([
            'id' => 'sumbersari',
            'nama' => 'Sumbersari'
        ]);
        Kecamatan::create([
            'id' => 'pakusari',
            'nama' => 'Pakusari'
        ]);
        Kecamatan::create([
            'id' => 'kebonsari',
            'nama' => 'Kebonsari'
        ]);
        Kecamatan::create([
            'id' => 'ajung',
            'nama' => 'Kebonsari'
        ]);
    }
}
