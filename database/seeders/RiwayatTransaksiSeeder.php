<?php

namespace Database\Seeders;

use App\Models\RiwayatTransaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(AlokasiSeeder::class);
        RiwayatTransaksi::insert([
            'id' => 1,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Tunai',
            'id_alokasi' => 1,
        ]);
        RiwayatTransaksi::insert([
            'id' => 2,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Tunai',
            'id_alokasi' => 2,
        ]);
        RiwayatTransaksi::insert([
            'id' => 3,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Tunai',
            'id_alokasi' => 3,
        ]);
    }
}
