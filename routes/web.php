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
    return view('homepage.index');
});
Route::prefix('/petani')->group(function(){
    Route::get('/login', function () {
        return view('homepage.petani.login');
    });
    Route::get('/register', function () {
        return view('homepage.petani.register');
    });
    Route::get('/lupaSandi', function () {
        return view('homepage.petani.lupa-sandi');
    });
    Route::get('/dashboard', function () {
        return view('dashboard.petani.index');
    });
    Route::get('/profil', function () {
        return view('dashboard.petani.profil');
    });
});
Route::get('/bot/retreive',[TelegramBotController::class,'show']);
Route::get('/bot/msg/',[TelegramBotController::class,'getMessages']);
Route::get('/bot/send/{id}',[TelegramBotController::class,'sendMessage']);
