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
        $this->call(MusimTanamSeeder::class);
        Pemerintah::create([
            'id' => 1,
            'nama_pengguna' => 'admin1',
            'kata_sandi' => Hash::make('pemerintah@1'),
            'id_musim_tanam' => 1
        ]);
    }
}
