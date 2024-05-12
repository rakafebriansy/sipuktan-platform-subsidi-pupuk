<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TelegramBotController;
use App\Jobs\UpdateMusimTanamJob;
use App\Models\KiosResmi;
use App\Models\KredensialUbahSandi;
use App\Models\Petani;
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
    Route::middleware('hasRole:petani')->group(function(){
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\Petani\AlokasiController::class, 'setAlokasi']);
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\Petani\DashboardController::class, 'setDashboard']);
        Route::get('/ganti-sandi', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'setGantiSandi']);
        Route::patch('/ganti-sandi', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'gantiSandi']);
        Route::patch('/ganti-nomor-telepon', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'gantiNoTelp']);
        Route::get('/transaksi', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setTransaksi']);
        Route::get('/checkout', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setCheckoutNonTunai']);
        Route::post('/checkout', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'checkoutNonTunai']);
        Route::get('/riwayat-transaksi', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setRiwayatTransaksi']);
        Route::get('/keluhan',[App\Http\Controllers\Dashboard\Petani\KeluhanController::class,'setKeluhan']);
        Route::post('/keluhan',[App\Http\Controllers\Dashboard\Petani\KeluhanController::class,'buatKeluhan']);
        Route::prefix('/ajax')->group(function(){
            Route::post('/delete-notifikasi',[AjaxController::class,'deleteNotifikasi']);
        });
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
    Route::middleware('hasRole:kios-resmi')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\KiosResmi\DashboardController::class, 'setDashboard']);
        Route::get('/ganti-sandi', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'setGantiSandi']);
        Route::patch('/ganti-sandi', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'gantiSandi']);
        Route::patch('/ganti-nomor-telepon', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'gantiNoTelp']);
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\KiosResmi\AlokasiController::class, 'setAlokasi']);
        Route::patch('/alokasi', [App\Http\Controllers\Dashboard\KiosResmi\AlokasiController::class, 'alokasi']);
        Route::get('/transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'setTransaksi']);
        Route::post('/transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'transaksi']);
        Route::get('/riwayat-transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'setRiwayatTransaksi']);
        Route::get('/laporan', [App\Http\Controllers\Dashboard\KiosResmi\LaporanController::class, 'setLaporan']);
        Route::post('/laporan', [App\Http\Controllers\Dashboard\KiosResmi\LaporanController::class, 'laporan']);
        Route::get('/keluhan',[App\Http\Controllers\Dashboard\KiosResmi\KeluhanController::class,'setKeluhan']);
        Route::post('/keluhan',[App\Http\Controllers\Dashboard\KiosResmi\KeluhanController::class,'buatKeluhan']);
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
    Route::middleware('hasRole:pemerintah')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\Pemerintah\DashboardController::class, 'setDashboard']);
        Route::get('/ganti-sandi', [App\Http\Controllers\Dashboard\Pemerintah\AkunController::class, 'setGantiSandi']);
        Route::patch('/ganti-sandi', [App\Http\Controllers\Dashboard\Pemerintah\AkunController::class, 'gantiSandi']);
        Route::get('/verifikasi-pengguna', [App\Http\Controllers\Dashboard\Pemerintah\VerifikasiController::class, 'setVerifikasi']);
        Route::post('/verifikasi-pengguna/petani', [App\Http\Controllers\Dashboard\Pemerintah\VerifikasiController::class, 'verifikasiPetani']);
        Route::post('/verifikasi-pengguna/kios-resmi', [App\Http\Controllers\Dashboard\Pemerintah\VerifikasiController::class, 'verifikasiKiosResmi']);
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'setAlokasi']);
        Route::post('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'buatAlokasi']);
        Route::put('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'hapusAlokasi']);
        Route::patch('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'editAlokasi']);
        Route::get('/laporan',[App\Http\Controllers\Dashboard\Pemerintah\LaporanController::class,'setLaporan']);
        Route::patch('/laporan',[App\Http\Controllers\Dashboard\Pemerintah\LaporanController::class,'laporan']);
        Route::get('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'setFaq']);
        Route::post('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'buatFaq']);
        Route::patch('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'editFaq']);
        Route::put('/faq',[App\Http\Controllers\Dashboard\Pemerintah\FaqController::class,'hapusFaq']);
        Route::get('/keluhan',[App\Http\Controllers\Dashboard\Pemerintah\KeluhanController::class,'setKeluhan']);
        Route::patch('/keluhan',[App\Http\Controllers\Dashboard\Pemerintah\KeluhanController::class,'balasKeluhan']);
        Route::prefix('/ajax')->group(function(){
            Route::post('/get-faq',[AjaxController::class,'getFaqDetail']);
        });
    });
});
Route::prefix('/ajax')->group(function(){
    Route::post('/laporan-filenames',[AjaxController::class,'getLaporanFilenames']);
    Route::post('/get-keluhan',[AjaxController::class,'getKeluhanDetail']);
});

Route::get('/logout', function(){
    Session::invalidate();
    return redirect("/");
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
        //
    });
    Route::get('/pusher', function(){
        return view('tests.pusher');
    });
    Route::get('/job', function(){
        UpdateMusimTanamJob::dispatch();
        return response()->json(['message' => 'ok']);
    });
});