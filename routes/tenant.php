<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\ZoneController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/test', function(){
        return tenant('id');
    })->name('test');

    Route::get('/', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/show/{booking}', [BookingController::class, 'show'])->name('booking.show');
    
    Route::middleware(['auth', 'verified'])->group(function(){
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::prefix('zone')->as('zone')->group(function(){
            Route::get('/', [ZoneController::class, 'index'])->name('');
            Route::get('/create', [ZoneController::class, 'create'])->name('.create');
            Route::post('/store', [ZoneController::class, 'store'])->name('.store');
            Route::get('/edit/{zone}', [ZoneController::class, 'edit'])->name('.edit');
            Route::put('/update/{zone}', [ZoneController::class, 'update'])->name('.update');
            Route::get('/delete/{zone}', [ZoneController::class, 'destroy'])->name('.delete');
        });
        Route::prefix('station')->as('station')->group(function(){
            Route::get('/', [StationController::class, 'index'])->name('');
            Route::get('/create', [StationController::class, 'create'])->name('.create');
            Route::post('/store', [StationController::class, 'store'])->name('.store');
            Route::get('/edit/{station}', [StationController::class, 'edit'])->name('.edit');
            Route::put('/update/{station}', [StationController::class, 'update'])->name('.update');
            Route::get('/delete/{station}', [StationController::class, 'destroy'])->name('.delete');
        });
        Route::prefix('distance')->as('distance')->group(function(){
            Route::get('/', [DistanceController::class, 'index'])->name('');
            Route::get('/create', [DistanceController::class, 'create'])->name('.create');
            Route::post('/store', [DistanceController::class, 'store'])->name('.store');
            Route::get('/edit/{distance}', [DistanceController::class, 'edit'])->name('.edit');
            Route::put('/update/{distance}', [DistanceController::class, 'update'])->name('.update');
            Route::get('/delete/{distance}', [DistanceController::class, 'destroy'])->name('.delete');
        });
        Route::prefix('booking')->as('booking')->group(function(){
            Route::get('/', [BookingController::class, 'index'])->name('');
            Route::get('/report/{type}', [BookingController::class, 'report'])->name('.report');
        });
    });        
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    require __DIR__.'/auth.php';
});
