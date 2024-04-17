<?php

use App\Helper\Helper;
use App\Http\Controllers\Ajax\AlokasiController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Dashboard\KiosResmiController;
use App\Http\Controllers\Dashboard\PemerintahController;
use App\Http\Controllers\Dashboard\PetaniController;
use App\Http\Controllers\Homepage\AuthController;
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

Route::get('/', function () {
    return view('homepage.pages.index', ['title' => 'Homepage']);
});

Route::prefix('/petani')->group(function(){
    Route::get('/login',[AuthController::class, 'setPetaniLogin']);
    Route::post('/login',[AuthController::class, 'petaniLogin']);
    Route::get('/register', [AuthController::class,'setPetaniRegister']);
    Route::post('/register', [AuthController::class,'petaniRegister']);
    Route::get('/lupa-sandi', [AuthController::class, 'setPetaniLupaSandi']);
    Route::post('/lupa-sandi', [AuthController::class, 'petaniLupaSandi']);
    Route::get('/ganti-sandi', [AuthController::class, 'setPetaniGantiSandi']);
    Route::patch('/ganti-sandi', [AuthController::class, 'petaniGantiSandi']);
    Route::get('/dashboard', [PetaniController::class, 'setDashboard']);
    Route::get('/alokasi', [PetaniController::class, 'setAlokasi']);
    // Route::middleware('petani')->group(function() {
    // });
        
});
Route::prefix('/kios-resmi')->group(function(){
    Route::get('/login', [AuthController::class, 'setKiosResmiLogin']);
    Route::post('/login',[AuthController::class, 'kiosResmiLogin']);
    Route::get('/register', [AuthController::class, 'setKiosResmiRegister']);
    Route::post('/register', [AuthController::class, 'kiosResmiRegister']);
    Route::get('/lupa-sandi', [AuthController::class, 'setKiosResmiLupaSandi']);
    Route::post('/lupa-sandi', [AuthController::class, 'kiosResmiLupaSandi']);
    Route::get('/ganti-sandi', [AuthController::class, 'setKiosResmiGantiSandi']);
    Route::patch('/ganti-sandi', [AuthController::class, 'kiosResmiGantiSandi']);
    Route::get('/dashboard', [KiosResmiController::class, 'setDashboard']);
    Route::get('/alokasi', [KiosResmiController::class, 'setAlokasi']);
    // Route::middleware('kiosResmi')->group(function() {
    // });
});

Route::get('/admin', [AuthController::class, 'setPemerintahLogin']);
Route::prefix('/pemerintah')->group(function(){
    Route::post('/login',[AuthController::class, 'pemerintahLogin']);
    Route::get('/dashboard', [PemerintahController::class, 'setDashboard']);
    Route::get('/verifikasi-pengguna', [PemerintahController::class, 'setVerifikasiPengguna']);
    Route::post('/verifikasi-pengguna/petani', [PemerintahController::class, 'verifikasiPenggunaPetani']);
    Route::post('/verifikasi-pengguna/kios-resmi', [PemerintahController::class, 'verifikasiPenggunaKiosResmi']);
    Route::get('/alokasi', [PemerintahController::class, 'setAlokasi']);
    Route::post('/alokasi', [PemerintahController::class, 'tambahAlokasi']);
    Route::put('/alokasi', [PemerintahController::class, 'hapusAlokasi']);
    Route::patch('/alokasi', [PemerintahController::class, 'editAlokasi']);
});
Route::prefix('/bot')->group(function(){
    Route::get('/retreive',[TelegramBotController::class,'show']);
    Route::get('/msg',[TelegramBotController::class,'getMessages']);
    Route::get('/send/{id}',[TelegramBotController::class,'sendMessage']);
});
Route::get('/logout', function(){
    Session::forget('id');
    if(!Session::has('id'))
    {
        return redirect('/');
    }
});
Route::get('/download/{folder_name}/{file_name}', function(string $folder_name, string $file_name){
    return Storage::disk('public')->download('/' . $folder_name . '/' . $file_name);
});
