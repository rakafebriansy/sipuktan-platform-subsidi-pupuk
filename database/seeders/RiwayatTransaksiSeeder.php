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
        RiwayatTransaksi::create([
            'id' => 1,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Non-Tunai',
            'status_pembayaran' => 'Dibayar',
            'id_alokasi' => 1,
            'id_bank' => 'bri'
        ]);
        RiwayatTransaksi::create([
            'id' => 2,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Non-Tunai',
            'status_pembayaran' => 'Dibayar',
            'id_alokasi' => 2,
            'id_bank' => 'bri'
        ]);
        RiwayatTransaksi::create([
            'id' => 3,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Tunai',
            'status_pembayaran' => 'Dibayar',
            'id_alokasi' => 3,
        ]);
        RiwayatTransaksi::create([
            'id' => 4,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Tunai',
            'status_pembayaran' => 'Menunggu Pembayaran',
            'id_alokasi' => 4,
        ]);
        RiwayatTransaksi::create([
            'id' => 5,
            'tanggal_transaksi' => fake()->date(),
            'metode_pembayaran' => 'Tunai',
            'status_pembayaran' => 'Menunggu Pembayaran',
            'id_alokasi' => 5,
        ]);
    }
}
