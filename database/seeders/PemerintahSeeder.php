<?php

namespace Database\Seeders;

use App\Models\Pemerintah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PemerintahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemerintah::create([
            'id' => 1,
            'nama_pengguna' => 'admin1',
            'kata_sandi' => Hash::make('pemerintah@1')
        ]);
        Pemerintah::create([
            'id' => 2,
            'nama_pengguna' => 'admin2',
            'kata_sandi' => Hash::make('pemerintah@2')
        ]);
        Pemerintah::create([
            'id' => 3,
            'nama_pengguna' => 'admin3',
            'kata_sandi' => Hash::make('pemerintah@3')
        ]);
    }
}
