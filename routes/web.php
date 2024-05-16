<?php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\GimnasioController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/registro',  'create')->name('formRegistro');
    Route::post('/registro', 'store')->name('registro');
});

Route::controller(PayPalController::class)->group(function () {
    Route::get('/paypal/payment',  'payment')->name('payment');
    Route::get('/paypal/success', 'success')->name('success');
    Route::get('/paypal/cancel', 'cancel')->name('cancel');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
