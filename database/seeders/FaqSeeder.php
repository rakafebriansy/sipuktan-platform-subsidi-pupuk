<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::insert([
            'id' => 1,
            'pertanyaan' => 'Bagaimana  cara mendaftar untuk mendapatkan pupuk subsidi?',
            'jawaban' => 'Silakan klik “Daftar Sekarang!” lanjut pilih masuk sebagai petani dan isi dengan data diri yang sesuai ',
            'jenis_pengguna' => 'Petani',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 2,
            'pertanyaan' => 'Apa saja pupuk yang diakomodasi oleh pemerintah ?',
            'jawaban' => 'Untuk tahun ini pupuk yang diakomodasi oleh pemerintah ada pupuk urea, pupuk ponskha, dan pupuk SP-36',
            'jenis_pengguna' => 'Petani',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 3,
            'pertanyaan' => 'Bagaimana jika tidak bisa mengambil pupuk?',
            'jawaban' => 'Pengambilan pupuk bisa diwakilkan dengan syarat membawa surat kuasa yang sudah diberi materai 10000 dan tanda tangan petani yang bersangkutan serta membawa ktp asli petani yang bersangkutan',
            'jenis_pengguna' => 'Petani',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 4,
            'pertanyaan' => 'Kenapa pupuk tahun ini terus turun?',
            'jawaban' => 'Pengalokasian pupuk subsidi pada tahun ini mengalami penurunan karena anggaran dari pemerintah pusat untuk pupuk subsidi dikurangi',
            'jenis_pengguna' => 'Petani',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 5,
            'pertanyaan' => 'Sampai kapan masa berlaku pengambilan pupuk?',
            'jawaban' => 'Sampai musim tanam atau MT alokasi berakhir yaitu selama 4 bulan sejak MT berlaku',
            'jenis_pengguna' => 'Petani',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 6,
            'pertanyaan' => 'Bagaimana  cara mendaftar untuk kios resmi?',
            'jawaban' => 'Silakan klik “Daftar Sekarang!” lanjut pilih masuk sebagai kios resmi dan isi dengan data diri yang sesuai',
            'jenis_pengguna' => 'Kios Resmi',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 7,
            'pertanyaan' => 'Apa ada syarat tertentu untuk foto laporan?',
            'jawaban' => 'Foto untuk pelaporan pembelian pupuk subsidi harus jelas dan tidak buram serta foto penerima dan foto ktp harus sesuai serta tidak lebih dari 5 mb',
            'jenis_pengguna' => 'Kios Resmi',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 8,
            'pertanyaan' => 'Apa yang perlu dilakukan jika pupuk sudah datang?',
            'jawaban' => 'Silakan klik tombol konfirmasi kedatangan untuk mengubah status ketersediaan pupuk di kios resmi dan petani ',
            'jenis_pengguna' => 'Kios Resmi',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 9,
            'pertanyaan' => 'Bagaimana jika masa pengambilan sudah habis tetapi ada yang belum mengambil?',
            'jawaban' => 'Alokasi pupuk bagi petani yang tidak mengambil sampai musim tanam berakhir akan otomatis berubah status menjadi “Tidak Diambil”',
            'jenis_pengguna' => 'Kios Resmi',
            'id_pemerintah' => 1
        ]);
        Faq::insert([
            'id' => 10,
            'pertanyaan' => 'Bagaimana jika saya lupa sandi saaat masuk?',
            'jawaban' => 'Silakan klik Lupa Sandi pada halaman masuk dan isikan username telegram dan secara otomatis sipuktan_bot akan mengirimkan pesan untuk pengisian kata sandi baru',
            'jenis_pengguna' => 'Kios Resmi',
            'id_pemerintah' => 1
        ]);
    }
}
