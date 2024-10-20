<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MensajesController;


Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::view('/privada', "secret")->middleware('auth')->name('privada');

Route::post('/validar-registro',[LoginController::class,'register'])->name('validar-registro');
Route::post('/inicia-sesion',[LoginController::class,'login'])->name('inicia-sesion');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/mensajes', [MensajesController::class, 'index'])->name('mensajes.index');
    Route::post('/mensajes', [MensajesController::class, 'store'])->name('mensajes.store');
});