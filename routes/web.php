<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

// Ruta inicial
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Rutas para administradores
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('rooms', RoomController::class)->except(['index', 'show']);
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::patch('reservations/{reservation}/update-status', [ReservationController::class, 'updateStatus'])
            ->name('admin.reservations.update-status');
        Route::get('admin/export-reservations', [AdminController::class, 'exportReservations'])
            ->name('admin.export-reservations');
    });

    //TODO: Rutas para todos los usuarios autenticados
    Route::resource('rooms', RoomController::class)->only(['index', 'show']);

    //TODO: Rutas para reservaciones con verificación de disponibilidad
    Route::middleware(['check.room.availability'])->group(function () {
        Route::resource('reservations', ReservationController::class);
    });
});
