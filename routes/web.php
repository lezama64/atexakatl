<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

//vistas de visitantes sin loguearse
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('/rutas', function () {
        return view('rutas');
    })->name('rutas');

    Route::get('/destinos', function () {
        return view('destinos');
    })->name('destinos');

    Route::get('/nosotros', function () {
        return view('nosotros');
    })->name('nosotros');
///////////////////////////////////////////



//vistas para el usuario
    Route::get('/mis_reservas', function () {
        return view('mis-reservas');
    })->name('mis-reservas');
//////////////////////////////////////////



//vistas para el admin
    Route::get('/reservaciones_confirmadas', function () {
        return view('reservaciones-confirmadas');
    })->name('reservaciones-confirmadas');

    Route::get('/reservaciones_por_confirmar', function () {
        return view('reservaciones-por-confirmar');
    })->name('reservaciones-por-confirmar');
/////////////////////////////////////////////////









Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
