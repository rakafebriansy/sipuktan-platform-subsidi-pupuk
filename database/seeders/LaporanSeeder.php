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
        Laporan::insert([
            'id' => 1,
            'tanggal_pengambilan'=> fake()->date(),
            'foto_bukti_pengambilan' => 'bukti001.jpg',
            'foto_ktp' => 'bukti-ktp001.jpg',
            'foto_surat_kuasa' => 'surat001.jpg',
            'foto_tanda_tangan' => 'ttd001.jpg',
            'status_verifikasi' => 'Belum Diverifikasi',
            'id_riwayat_transaksi' => 1
        ]);
        Laporan::insert([
            'id' => 2,
            'tanggal_pengambilan'=> fake()->date(),
            'foto_bukti_pengambilan' => 'bukti002.jpg',
            'foto_ktp' => 'bukti-ktp002.jpg',
            'foto_surat_kuasa' => 'surat002.jpg',
            'foto_tanda_tangan' => 'ttd002.jpg',
            'status_verifikasi' => 'Belum Diverifikasi',
            'id_riwayat_transaksi' => 2
        ]);
        Laporan::insert([
            'id' => 3,
            'tanggal_pengambilan'=> fake()->date(),
            'foto_bukti_pengambilan' => 'bukti003.jpg',
            'foto_ktp' => 'bukti-ktp003.jpg',
            'foto_surat_kuasa' => 'surat003.jpg',
            'foto_tanda_tangan' => 'ttd003.jpg',
            'status_verifikasi' => 'Belum Diverifikasi',
            'id_riwayat_transaksi' => 3
        ]);
    }
}
