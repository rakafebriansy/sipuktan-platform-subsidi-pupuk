<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TelegramBotController;
use App\Jobs\UpdateMusimTanamJob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[App\Http\Controllers\Homepage\HomepageController::class,'index']);

Route::prefix('/petani')->group(function(){
    Route::get('/login',[App\Http\Controllers\Homepage\Petani\AkunController::class, 'setLogin']);
    Route::post('/login',[App\Http\Controllers\Homepage\Petani\AkunController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Homepage\Petani\AkunController::class,'setRegister']);
    Route::post('/register', [App\Http\Controllers\Homepage\Petani\AkunController::class,'register']);
    Route::get('/lupa-sandi', [App\Http\Controllers\Homepage\Petani\AkunController::class, 'setLupaSandi']);
    Route::post('/lupa-sandi', [App\Http\Controllers\Homepage\Petani\AkunController::class, 'lupaSandi']);
    Route::get('/lupa-ubah-sandi', [App\Http\Controllers\Homepage\Petani\AkunController::class, 'setUbahSandi']);
    Route::post('/lupa-ubah-sandi', [App\Http\Controllers\Homepage\Petani\AkunController::class, 'ubahSandi']);
    Route::middleware('authPetani')->group(function(){
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\Petani\AlokasiController::class, 'setAlokasi']);
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\Petani\DashboardController::class, 'setDashboard']);
        Route::get('/ubah-sandi', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'setUbahSandi']);
        Route::patch('/ubah-sandi', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'ubahSandi']);
        Route::patch('/ubah-nomor-telepon', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'ubahNoTelp']);
        Route::get('/transaksi', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setTransaksi']);
        Route::get('/checkout', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setCheckoutNonTunai']);
        Route::post('/checkout', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'checkoutNonTunai']);
        Route::get('/riwayat-transaksi', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setRiwayatTransaksi']);
        Route::get('/keluhan',[App\Http\Controllers\Dashboard\Petani\KeluhanController::class,'setKeluhan']);
        Route::post('/keluhan',[App\Http\Controllers\Dashboard\Petani\KeluhanController::class,'buatKeluhan']);
        Route::get('/logout',[App\Http\Controllers\Dashboard\Petani\AkunController::class,'logout']);
    });
});
Route::prefix('/kios-resmi')->group(function(){
    Route::get('/login', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'setLogin']);
    Route::post('/login',[App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'setRegister']);
    Route::post('/register', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'register']);
    Route::get('/lupa-sandi', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'setLupaSandi']);
    Route::post('/lupa-sandi', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'lupaSandi']);
    Route::get('/lupa-ubah-sandi', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'setUbahSandi']);
    Route::post('/lupa-ubah-sandi', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'ubahSandi']);
    Route::middleware('authKiosResmi')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\KiosResmi\DashboardController::class, 'setDashboard']);
        Route::get('/ubah-sandi', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'setUbahSandi']);
        Route::patch('/ubah-sandi', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'ubahSandi']);
        Route::patch('/ubah-nomor-telepon', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'ubahNoTelp']);
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\KiosResmi\AlokasiController::class, 'setAlokasi']);
        Route::patch('/alokasi', [App\Http\Controllers\Dashboard\KiosResmi\AlokasiController::class, 'alokasi']);
        Route::get('/transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'setTransaksi']);
        Route::post('/transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'transaksi']);
        Route::get('/riwayat-transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'setRiwayatTransaksi']);
        Route::get('/laporan', [App\Http\Controllers\Dashboard\KiosResmi\LaporanController::class, 'setLaporan']);
        Route::post('/laporan', [App\Http\Controllers\Dashboard\KiosResmi\LaporanController::class, 'laporan']);
        Route::put('/laporan', [App\Http\Controllers\Dashboard\KiosResmi\LaporanController::class, 'ubahLaporan']);
        Route::get('/keluhan',[App\Http\Controllers\Dashboard\KiosResmi\KeluhanController::class,'setKeluhan']);
        Route::post('/keluhan',[App\Http\Controllers\Dashboard\KiosResmi\KeluhanController::class,'buatKeluhan']);
        Route::get('/logout',[App\Http\Controllers\Dashboard\KiosResmi\AkunController::class,'logout']);
        Route::prefix('/ajax')->group(function(){
            Route::post('/petani-riwayat',[AjaxController::class,'getPetaniFromRiwayat']);
            Route::post('/petani-alokasi',[AjaxController::class,'getPetaniFromAlokasi']);
        });
    });
});

Route::get('/admin', function() {
    return redirect('/pemerintah/login');
});
Route::prefix('/pemerintah')->group(function(){
    Route::get('/login',[App\Http\Controllers\Homepage\Pemerintah\AkunController::class, 'setLogin']);
    Route::post('/login',[App\Http\Controllers\Homepage\Pemerintah\AkunController::class, 'login']);
    Route::middleware('authPemerintah')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\Pemerintah\DashboardController::class, 'setDashboard']);
        Route::get('/ubah-sandi', [App\Http\Controllers\Dashboard\Pemerintah\AkunController::class, 'setUbahSandi']);
        Route::patch('/ubah-sandi', [App\Http\Controllers\Dashboard\Pemerintah\AkunController::class, 'ubahSandi']);
        Route::get('/verifikasi-pengguna', [App\Http\Controllers\Dashboard\Pemerintah\VerifikasiController::class, 'setVerifikasi']);
        Route::post('/verifikasi-pengguna/petani', [App\Http\Controllers\Dashboard\Pemerintah\VerifikasiController::class, 'verifikasiPetani']);
        Route::post('/verifikasi-pengguna/kios-resmi', [App\Http\Controllers\Dashboard\Pemerintah\VerifikasiController::class, 'verifikasiKiosResmi']);
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'setAlokasi']);
        Route::post('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'buatAlokasi']);
        Route::delete('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'hapusAlokasi']);
        Route::patch('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'editAlokasi']);
        Route::get('/laporan',[App\Http\Controllers\Dashboard\Pemerintah\LaporanController::class,'setLaporan']);
        Route::patch('/laporan',[App\Http\Controllers\Dashboard\Pemerintah\LaporanController::class,'setujuiLaporan']);
        Route::delete('/laporan',[App\Http\Controllers\Dashboard\Pemerintah\LaporanController::class,'tolakLaporan']);
        Route::get('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'setFaq']);
        Route::post('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'buatFaq']);
        Route::patch('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'editFaq']);
        Route::delete('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'hapusFaq']);
        Route::get('/keluhan',[App\Http\Controllers\Dashboard\Pemerintah\KeluhanController::class,'setKeluhan']);
        Route::patch('/keluhan',[App\Http\Controllers\Dashboard\Pemerintah\KeluhanController::class,'balasKeluhan']);
        Route::get('/kelompok-tani',[App\Http\Controllers\Dashboard\Pemerintah\KelompokTaniController::class,'setKelompokTani']);
        Route::post('/kelompok-tani',[App\Http\Controllers\Dashboard\Pemerintah\KelompokTaniController::class,'buatKelompokTani']);
        Route::patch('/kelompok-tani',[App\Http\Controllers\Dashboard\Pemerintah\KelompokTaniController::class,'editKelompokTani']);
        Route::delete('/kelompok-tani',[App\Http\Controllers\Dashboard\Pemerintah\KelompokTaniController::class,'hapusKelompokTani']);
        Route::get('/logout',[App\Http\Controllers\Dashboard\Pemerintah\AkunController::class,'logout']);
        Route::prefix('/ajax')->group(function(){
            Route::post('/get-faq',[AjaxController::class,'getFaqDetail']);
            Route::post('/petani-alokasi',[AjaxController::class,'getPetaniFromAlokasiPemerintah']);
            Route::post('/get-laporan-blade',[AjaxController::class,'getLaporanBlade']);
            Route::post('/get-keluhan-blade',[AjaxController::class,'getKeluhanBlade']);
            Route::post('/get-kios',[AjaxController::class,'getKios']);
        });
    });
});
Route::prefix('/ajax')->group(function(){
    Route::post('/delete-notifikasi',[AjaxController::class,'deleteNotifikasi']);
    Route::post('/laporan-filenames',[AjaxController::class,'getLaporanFilenames']);
    Route::post('/get-keluhan',[AjaxController::class,'getKeluhanDetail']);
});
Route::get('/download/{folder_name}/{file_name}', function(string $folder_name, string $file_name){
    return Storage::disk('public')->download('/' . $folder_name . '/' . $file_name);
});

Route::prefix('/bot')->group(function(){
    Route::get('/get-bot-info',[TelegramBotController::class,'getBotInformation']);
    Route::get('/msg',[TelegramBotController::class,'getMessagesByPolling']);
    Route::get('/send/{id}',[TelegramBotController::class,'sendMessage']);

    Route::get('/set-webhook',[TelegramBotController::class,'setWebhook']);
    Route::post('/webhook/{token}',[TelegramBotController::class,'getMessagesByWebhook']);
});
Route::prefix('/test')->group(function(){
    Route::get('/',function(){
        return view('dashboard.pemerintah.elements.laporan-dropdowns')->render();
    });
    Route::get('/pusher', function(){
        return view('tests.pusher');
    });
    Route::get('/job', function(){
        UpdateMusimTanamJob::dispatch();
        return response()->json(['message' => 'ok']);
    });
});