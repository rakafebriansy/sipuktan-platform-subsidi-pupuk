<?php

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
    return 'ok';
});
Route::post('/login',[AuthController::class, 'login']);

Route::prefix('/petani')->group(function(){
    Route::get('/login',[AuthController::class, 'setPetaniLogin']);
    Route::get('/register', [AuthController::class,'setPetaniRegister']);
    Route::post('/register', [AuthController::class,'petaniRegister']);
    Route::get('/lupa-sandi', [AuthController::class, 'setPetaniLupaSandi']);
    Route::post('/lupa-sandi', [AuthController::class, 'petaniLupaSandi']);
    Route::group(['middleware'=>'petani'], function() {
        Route::get('/dashboard', []);
        Route::get('/alokasi', []);
    });
});
Route::prefix('/kios-resmi')->group(function(){
    Route::get('/login', [AuthController::class, 'setKiosResmiLogin']);
    Route::get('/register', [AuthController::class, 'setKiosResmiRegister']);
    Route::post('/register', [AuthController::class, 'kiosResmiRegister']);
    Route::get('/lupa-sandi', [AuthController::class, 'setKiosResmiLupaSandi']);
    Route::post('/lupa-sandi', [AuthController::class, 'kiosResmiLupaSandi']);
    Route::group(['middleware'=>'kiosResmi'], function() {
        Route::get('/dashboard', []);
        Route::get('/alokasi', []);
    });
});

Route::get('/admin', [AuthController::class, 'setPemerintahLogin']);
Route::prefix('/pemerintah')->group(function(){
    Route::get('/dashboard', [])->middleware('pemerintah');
});
Route::prefix('/bot')->group(function(){
    Route::get('/retreive',[TelegramBotController::class,'show']);
    Route::get('/msg/',[TelegramBotController::class,'getMessages']);
    Route::get('/send/{id}',[TelegramBotController::class,'sendMessage']);
});
