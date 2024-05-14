<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(RiwayatTransaksiSeeder::class);
        Laporan::insert([
            'id' => 1,
            'tanggal_pengambilan'=> fake()->date(),
            'foto_bukti_pengambilan' => 'bukti-1.jpg',
            'foto_ktp' => 'bukti-2.jpg',
            'foto_surat_kuasa' => 'bukti-4.jpg',
            'foto_tanda_tangan' => 'bukti-3.jpg',
            'status_verifikasi' => 'Belum Diverifikasi',
            'id_riwayat_transaksi' => 1
        ]);
    }
}
