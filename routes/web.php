<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::resource('equipment', \App\Http\Controllers\EquipmentController::class)
        ->only('index', 'create', 'store', 'destroy', 'edit', 'update');
    Route::put('/equipment/{id}/change-image', [\App\Http\Controllers\EquipmentController::class, 'changeImage'])
        ->name('equipment.change-image');
});

Route::name('guest.')->group(function () {
    Route::get('/', [\App\Http\Controllers\GuestController::class, 'index'])->name('index');
    Route::get('/equipment/{id}/detail', [\App\Http\Controllers\GuestController::class, 'equipmentDetail'])->name('equipment-detail');
});
