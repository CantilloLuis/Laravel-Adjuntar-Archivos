<?php

use App\Http\Controllers\archivoController;
use Illuminate\Support\Facades\Route;

Route::get('/principal', [archivoController::class, 'index'])->name('principal');

Route::post('/archivo', [archivoController::class, 'store'])->name('archivo');
Route::get('archivos/download/{id}', [ArchivoController::class, 'download'])->name('archivos.download');
Route::delete('archivos/{id}', [ArchivoController::class, 'destroy'])->name('archivos.destroy');
