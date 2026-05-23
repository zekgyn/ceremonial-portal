<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Client;
use App\Http\Controllers\Vendor;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Landing', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth'])->group(function () {

    // Client routes
    Route::middleware(['role:client,admin'])->group(function () {
        Route::get('/dashboard', Client\DashboardController::class)->name('dashboard');

        Route::prefix('events')->name('events.')->group(function () {
            Route::get('/', [Client\EventController::class, 'index'])->name('index');
            Route::get('/create', [Client\EventController::class, 'create'])->name('create');
            Route::post('/', [Client\EventController::class, 'store'])->name('store');
            Route::get('/{event}', [Client\EventController::class, 'show'])->name('show');
            Route::get('/{event}/edit', [Client\EventController::class, 'edit'])->name('edit');
            Route::put('/{event}', [Client\EventController::class, 'update'])->name('update');
            Route::delete('/{event}', [Client\EventController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('vendors')->name('vendors.')->group(function () {
            Route::get('/', [Client\VendorController::class, 'index'])->name('index');
            Route::get('/{vendor}', [Client\VendorController::class, 'show'])->name('show');
        });

        Route::get('/packages/{package}', [Client\VendorController::class, 'packageShow'])->name('packages.show');

        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [Client\BookingController::class, 'index'])->name('index');
            Route::post('/', [Client\BookingController::class, 'store'])->name('store');
            Route::delete('/{booking}', [Client\BookingController::class, 'destroy'])->name('destroy');
        });
    });

    // Vendor routes
    Route::middleware(['role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', Vendor\DashboardController::class)->name('dashboard');

        Route::get('/profile', [Vendor\VendorProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/setup', [Vendor\VendorProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile', [Vendor\VendorProfileController::class, 'store'])->name('profile.store');
        Route::put('/profile', [Vendor\VendorProfileController::class, 'update'])->name('profile.update');

        Route::prefix('packages')->name('packages.')->group(function () {
            Route::get('/', [Vendor\PackageController::class, 'index'])->name('index');
            Route::get('/create', [Vendor\PackageController::class, 'create'])->name('create');
            Route::post('/', [Vendor\PackageController::class, 'store'])->name('store');
            Route::get('/{package}/edit', [Vendor\PackageController::class, 'edit'])->name('edit');
            Route::put('/{package}', [Vendor\PackageController::class, 'update'])->name('update');
            Route::delete('/{package}', [Vendor\PackageController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', [Vendor\BookingController::class, 'index'])->name('index');
            Route::patch('/{booking}/status', [Vendor\BookingController::class, 'updateStatus'])->name('status');
        });
    });

    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', Admin\DashboardController::class)->name('dashboard');
        Route::get('/vendors', [Admin\VendorController::class, 'index'])->name('vendors.index');
        Route::patch('/vendors/{vendor}/verify', [Admin\VendorController::class, 'toggleVerified'])->name('vendors.verify');
    });
});

require __DIR__ . '/settings.php';
