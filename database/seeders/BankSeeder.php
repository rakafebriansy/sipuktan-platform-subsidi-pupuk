<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create([
            'id' => 'bri',
            'nama' => 'Bank Rakyat Indonesia'
        ]);
        Bank::create([
            'id' => 'bca',
            'nama' => 'Bank Central Asia'
        ]);
        Bank::create([
            'id' => 'seabank',
            'nama' => 'SeaBank Indonesia'
        ]);
    }
}
