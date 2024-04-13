<?php

namespace Database\Seeders;

use App\Models\PemilikKios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemilikKiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PemilikKios::create([
            'nib',
            'nama',
            'kata_sandi',
            'foto_ktp',
            'nomor_telepon'
        ]);
    }
}
