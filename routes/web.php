<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TelegramBotController;
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
    Route::post('/lupa-sandi', [App\Http\Controllers\Homepage\Petani\AkunController::class, 'LupaSandi']);
    Route::middleware('hasRole:petani')->group(function(){
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\Petani\AlokasiController::class, 'setAlokasi']);
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\Petani\DashboardController::class, 'setDashboard']);
        Route::get('/ganti-sandi', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'setGantiSandi']);
        Route::patch('/ganti-sandi', [App\Http\Controllers\Dashboard\Petani\AkunController::class, 'gantiSandi']);
        Route::get('/transaksi', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setTransaksi']);
        Route::get('/checkout', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setCheckoutNonTunai']);
        Route::post('/checkout', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'checkoutNonTunai']);
        Route::get('/riwayat-transaksi', [App\Http\Controllers\Dashboard\Petani\TransaksiController::class, 'setRiwayatTransaksi']);
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
    Route::get('/lupa-sandi', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'lupaSandi']);
    Route::post('/lupa-sandi', [App\Http\Controllers\Homepage\KiosResmi\AkunController::class, 'lupaSandi']);
    Route::middleware('hasRole:kios-resmi')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\KiosResmi\DashboardController::class, 'setDashboard']);
        Route::get('/ganti-sandi', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'setGantiSandi']);
        Route::patch('/ganti-sandi', [App\Http\Controllers\Dashboard\KiosResmi\AkunController::class, 'gantiSandi']);
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\KiosResmi\AlokasiController::class, 'setAlokasi']);
        Route::patch('/alokasi', [App\Http\Controllers\Dashboard\KiosResmi\AlokasiController::class, 'alokasi']);
        Route::get('/transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'setTransaksi']);
        Route::post('/transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'transaksi']);
        Route::get('/riwayat-transaksi', [App\Http\Controllers\Dashboard\KiosResmi\TransaksiController::class, 'setRiwayatTransaksi']);
        Route::get('/laporan', [App\Http\Controllers\Dashboard\KiosResmi\LaporanController::class, 'setLaporan']);
        Route::post('/laporan', [App\Http\Controllers\Dashboard\KiosResmi\LaporanController::class, 'laporan']);
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
        Route::post('/verifikasi-/kios-resmi', [App\Http\Controllers\Dashboard\Pemerintah\VerifikasiController::class, 'verifikasiKiosResmi']);
        Route::get('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'setAlokasi']);
        Route::post('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'tambahAlokasi']);
        Route::put('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'hapusAlokasi']);
        Route::patch('/alokasi', [App\Http\Controllers\Dashboard\Pemerintah\AlokasiController::class, 'editAlokasi']);
        Route::get('/laporan',[App\Http\Controllers\Dashboard\Pemerintah\LaporanController::class,'setLaporan']);
        Route::patch('/laporan',[App\Http\Controllers\Dashboard\Pemerintah\LaporanController::class,'laporan']);
    });
});
Route::prefix('/ajax')->group(function(){
    Route::post('/laporan-filenames',[AjaxController::class,'getLaporanFilenames']);
});
Route::prefix('/bot')->group(function(){
    Route::get('/retreive',[TelegramBotController::class,'show']);
    Route::get('/msg',[TelegramBotController::class,'getMessages']);
    Route::get('/send/{id}',[TelegramBotController::class,'sendMessage']);
});


Route::get('/logout', function(){
    Session::invalidate();
    return redirect("/");
});
Route::get('/download/{folder_name}/{file_name}', function(string $folder_name, string $file_name){
    return Storage::disk('public')->download('/' . $folder_name . '/' . $file_name);
});
Route::get('/test/pusher', function(){
    return view('tests.pusher');
});
