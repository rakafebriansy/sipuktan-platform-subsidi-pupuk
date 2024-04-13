<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'id' => 'pendaftaran',
            'nama' => 'Pendaftaran',
        ]);
        Kategori::create([
            'id' => 'jumlah-pupuk',
            'nama' => 'Jumlah Pupuk',
        ]);
        Kategori::create([
            'id' => 'kelayakan-penerima',
            'nama' => 'Kelayakan Penerima',
        ]);
        Kategori::create([
            'id' => 'akses-wilayah',
            'nama' => 'Akses Wilayah',
        ]);
        Kategori::create([
            'id' => 'program-pemerintah',
            'nama' => 'Program Pemerintah',
        ]);
    }
}
