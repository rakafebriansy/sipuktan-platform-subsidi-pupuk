<?php

use App\Http\Controllers\TelegramBotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/bot')->group(function(){
    Route::get('/retreive',[TelegramBotController::class,'show']);
    Route::get('/msg',[TelegramBotController::class,'getMessages']);
    Route::get('/send/{id}',[TelegramBotController::class,'sendMessage']);
});
