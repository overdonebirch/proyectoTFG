<?php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\GimnasioController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(GimnasioController::class)->group(function () {
    Route::get('/inicio', 'index')->name('inicio');
    Route::get('/dondeEstamos', 'dondeEstamos')->name('dondeEstamos');
    Route::get('/gimnasio/{gimnasio}', 'gimnasio')->name('gimnasio');
});


Route::controller(ClaseController::class)->group(function () {
    Route::get('/clases', 'index')->name("clases");
});

Route::controller(ReservaController::class)->group(function () {
    Route::get('/reservarClase/{clase}/{fecha}/{horaInicio}/{horaFin}/{gimnasio}', 'create')->name("reservarClase")->middleware('booking');
    Route::post('/reservar/{clase}/{fecha}/{horaInicio}/{horaFin}/{gimnasio}/{dniUsuario}', 'store')->name("reservar");
    Route::get('/reservarNoUsuario/{clase}/{fecha}/{horaInicio}/{horaFin}/{gimnasio}', 'reservarNoUsuario')->name("reservarNoUsuario");
    Route::get('/redirectBookingToStore', 'redirectBookingToStore')->name("redirectBookingToStore"); // Ruta usada para redireccionar al store cuando reserva un no usuario
    Route::post('/verificarReservaNoUsuario','verificarReservaNoUsuario')->name("verificarReservaNoUsuario");
});


Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'formLogin')->middleware('guest');
    Route::get('/logout', 'logout');
    Route::post('/login', 'login')->name('login');
    Route::get('/registro',  'create')->name('formRegistro');
    Route::post('/registro', 'store')->name('registro');
    Route::get('/perfil', 'perfil')->name('perfil');
});

Route::controller(PayPalController::class)->group(function () {
    Route::get('/paypal/payment',  'payment')->name('payment');
    Route::post('/paypal/bookingPayment', 'bookingPayment')->name('bookingPayment');
    Route::get('/paypal/success', 'success')->name('success');
    Route::get('/paypal/bookingSuccess', 'bookingSuccess')->name('bookingSuccess');
    Route::get('/paypal/cancel', 'cancel')->name('cancel');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
