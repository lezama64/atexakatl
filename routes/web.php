<?php

use App\Http\Controllers\DestinoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ReservaController;

Route::get('/welcome', function () {
    return view('welcome');
});

//vistas de visitantes sin loguearse
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::get('/rutas', [RutaController::class, 'index'])->name('rutas');

    Route::get('/ruta/{id}', [RutaController::class, 'show'])->name('ruta.show');

    Route::get('/destinos', [DestinoController::class, 'index'])->name('destinos');

    Route::get('/destino/{id}', [DestinoController::class, 'show'])->name('destino.show');


    Route::resource('reservas', ReservaController::class);

/*
    Route::get('/rutas', function () {
        return view('rutas');
    })->name('rutas');

    Route::get('/destinos', function () {
        return view('destinos');
    })->name('destinos');
*/
    Route::get('/nosotros', function () {
        return view('nosotros');
    })->name('nosotros');
///////////////////////////////////////////



//vistas para el usuario
/*
    Route::get('/mis_reservas', function () {
        return view('mis-reservas');
    })->name('mis-reservas');


    Route::get('/mis-reservas', function () {
    return view('mis-reservas');
})->middleware(['auth', 'verified'])->name('mis-reservas');
*/

Route::get('/mis-reservas', [ReservaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('mis-reservas');
//////////////////////////////////////////


/*
//vistas para el admin
    Route::get('/reservaciones_confirmadas', function () {
        return view('reservaciones-confirmadas');
    })->name('reservaciones-confirmadas');
*/


/////////////////////////////////////////////////



// ✅ VISTAS PROTEGIDAS SOLO PARA ADMIN

Route::middleware(['admin'])->group(function () {



            Route::get('/reservaciones_confirmadas', [ReservaController::class, 'confirmadas'])
        ->name('reservaciones-confirmadas');

        Route::get('/reservaciones_por_confirmar', [ReservaController::class, 'pendientes'])
        ->name('reservaciones-por-confirmar');

    Route::patch('/reservas/{id}/actualizar-estado', [ReservaController::class, 'actualizarEstado'])
        ->name('reservas.actualizar-estado');

            Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])
        ->name('reservas.destroy');


            // ✅ NUEVAS RUTAS PARA EDITAR
    Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])
        ->name('reservas.edit');
    
    Route::put('/reservas/{id}', [ReservaController::class, 'update'])
        ->name('reservas.update');

    Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])
        ->name('reservas.destroy');
});

/*
Route::middleware(['admin'])->group(function () {
    Route::get('/reservaciones_confirmadas', function () {
        return view('reservaciones-confirmadas');
    })->name('reservaciones-confirmadas');

    Route::get('/reservaciones_por_confirmar', [ReservaController::class, 'pendientes'])
        ->name('reservaciones-por-confirmar');
});
*/


//////////Reservas/////////////////////////
Route::middleware(['auth'])->group(function () {
    // Ruta para crear reserva desde una ruta específica
    Route::get('/rutas/{ruta}/reservar', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

        Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])
        ->name('reservas.edit');
    
    Route::put('/reservas/{id}', [ReservaController::class, 'update'])
        ->name('reservas.update');
});
///////////////////////////////////////////////////////////////////////////////////////////////




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
