<?php

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
    return view('homepage.pages.index');
});
Route::prefix('/petani')->group(function(){
    Route::get('/login', function () {
        return view('homepage.pages.petani.login');
    });
    Route::get('/register', function () {
        return view('homepage.pages.petani.register');
    });
    Route::get('/lupa-sandi', function () {
        return view('homepage.pages.petani.lupa-sandi');
    });
    Route::get('/dashboard', function () {
        return view('dashboard.petani.pages.index');
    });
    Route::get('/alokasi', function () {
        return view('dashboard.petani.pages.alokasi');
    });
});
Route::prefix('/kios-resmi')->group(function(){
    Route::get('/login', function () {
        return view('homepage.pages.kios-resmi.login');
    });
    Route::get('/register', function () {
        return view('homepage.pages.kios-resmi.register');
    });
    Route::get('/lupa-sandi', function () {
        return view('homepage.pages.kios-resmi.lupa-sandi');
    });
    Route::get('/dashboard', function () {
        return view('dashboard.kios-resmi.pages.index');
    });
    Route::get('/alokasi', function () {
        return view('dashboard.kios-resmi.pages.alokasi');
    });
});
Route::get('/admin', function () {
    return view('homepage.pages.pemerintah.login');
});
Route::prefix('/pemerintah')->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard.pemerintah.pages.index');
    });
    Route::get('/alokasi', function () {
        return view('dashboard.pemerintah.pages.alokasi');
    });
});
Route::prefix('/bot')->group(function(){
    Route::get('/retreive',[TelegramBotController::class,'show']);
    Route::get('/msg/',[TelegramBotController::class,'getMessages']);
    Route::get('/send/{id}',[TelegramBotController::class,'sendMessage']);
});
