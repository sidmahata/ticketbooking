<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/zones', [ZoneController::class, 'index'])->name('zones');
    Route::get('/zone/create', [ZoneController::class, 'create'])->name('zone.create');
    Route::post('/zone/store', [ZoneController::class, 'store'])->name('zone.store');
    Route::get('/zone/edit/{zone}', [ZoneController::class, 'edit'])->name('zone.edit');
    Route::put('/zone/update/{zone}', [ZoneController::class, 'update'])->name('zone.update');
    Route::get('/zone/delete/{zone}', [ZoneController::class, 'destroy'])->name('zone.delete');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
