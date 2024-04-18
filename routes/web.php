<?php

use App\Http\Controllers\BankaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Route::get('/register',[UserController::class,'register'])->middleware('guest');
Route::get('/login',[UserController::class,'login'])->middleware('guest');;
Route::post('/user',[UserController::class,'store']);
Route::post('/logout',[UserController::class,'logout']);
Route::post('/user/authenticate',[UserController::class,'authenticate']);

Route::get('/banka',[BankaController::class,'show'])->middleware('auth');
Route::post('/banka/money', [BankaController::class,'money'])->middleware('auth');
Route::post('/banka/kontokorentChecked',[BankaController::class,'switchKontokorent'])->middleware('auth');
Route::post('/banka/kontokorentSet',[BankaController::class,'setKontokorent'])->middleware('auth');
Route::post('/banka/lend',[BankaController::class,'lend'])->middleware('auth');
Route::post('/banka/splatit',[BankaController::class,'splatit'])->middleware('auth');
