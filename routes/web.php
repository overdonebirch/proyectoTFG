<?php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\GimnasioController;
use App\Http\Controllers\TipoClaseController;
use App\Models\TipoClase;
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


Route::controller(GimnasioController::class)->group(function () {
    Route::get('/gyms', 'index');
});

Route::controller(TipoClaseController::class)->group(function () {
    Route::get('/tipos', 'index');
});


Route::controller(ClaseController::class)->group(function () {
    Route::get('/clases', 'index');
});


