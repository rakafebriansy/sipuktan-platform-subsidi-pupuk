<?php

namespace Database\Seeders;

use App\Models\JenisPupuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPupukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPupuk::insert([
            'id' => 'ponskha',
            'jenis' => 'Ponshka',
            'harga' => 2300
        ]);
        JenisPupuk::insert([
            'id' => 'urea',
            'jenis' => 'Urea',
            'harga' => 2250
        ]);
        JenisPupuk::insert([
            'id' => 'sp36',
            'jenis' => 'SP-36',
            'harga' => 2400
        ]);
    }
}
