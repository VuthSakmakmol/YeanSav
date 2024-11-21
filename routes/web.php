<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

// Public routes (accessible without login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/service', [ServiceController::class, 'index'])->name('service');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Public Service Detail routes (accessible without login)
Route::prefix('services/{service}')->group(function () {
    Route::get('detail/{serviceDetail}', [ServiceDetailController::class, 'show'])->name('service.detail.show'); // Show single detail
    Route::get('details', [ServiceDetailController::class, 'showDetail'])->name('service.details.show-all'); // Show all details for a service
});

// Authentication routes setup (from Laravel Breeze or similar package)
require __DIR__ . '/auth.php';

// Authenticated routes (only accessible to logged-in users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});

// Admin routes (only accessible by admins)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Home Page CRUD
    Route::prefix('home')->group(function () {
        Route::get('create', [HomeController::class, 'create'])->name('home.create');
        Route::post('/', [HomeController::class, 'store'])->name('home.store');
        Route::get('{id}/edit', [HomeController::class, 'edit'])->name('home.edit');
        Route::put('{id}', [HomeController::class, 'update'])->name('home.update');
        Route::delete('{id}', [HomeController::class, 'destroy'])->name('home.delete');
    });

    // Service CRUD
    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services.index'); // List services
        Route::get('create', [ServiceController::class, 'create'])->name('service.create'); // Show create form
        Route::post('store', [ServiceController::class, 'store'])->name('service.store'); // Store a new service
        Route::get('{service}/edit', [ServiceController::class, 'edit'])->name('service.edit'); // Edit form
        Route::put('{service}', [ServiceController::class, 'update'])->name('services.update'); // Update service
        Route::delete('{service}', [ServiceController::class, 'destroy'])->name('services.destroy'); // Delete service
    });

    // // Service Detail CRUD
    // Route::prefix('services/{service}')->group(function () {
    //     Route::get('detail/create', [ServiceDetailController::class, 'create'])->name('service.detail.create'); // Show create form for details
    //     Route::post('detail', [ServiceDetailController::class, 'store'])->name('service.detail.store'); // Store service detail
    //     Route::get('detail/{serviceDetail}/edit', [ServiceDetailController::class, 'edit'])->name('service.detail.edit'); // Edit form for detail
    //     Route::put('detail/{serviceDetail}', [ServiceDetailController::class, 'update'])->name('service.detail.update'); // Update service detail
    //     Route::delete('detail/{serviceDetail}', [ServiceDetailController::class, 'destroy'])->name('service.detail.destroy'); // Delete service detail
    // });
    // Admin routes for creating/editing/deleting service details
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('services/{service}')->group(function () {
        Route::get('detail/create', [ServiceDetailController::class, 'create'])->name('service.detail.create'); // Show create form for details
        Route::post('detail', [ServiceDetailController::class, 'store'])->name('service.detail.store'); // Store service detail
        Route::get('detail/{serviceDetail}/edit', [ServiceDetailController::class, 'edit'])->name('service.detail.edit'); // Edit form for detail
        Route::put('detail/{serviceDetail}', [ServiceDetailController::class, 'update'])->name('service.detail.update'); // Update service detail
        Route::delete('detail/{serviceDetail}', [ServiceDetailController::class, 'destroy'])->name('service.detail.destroy'); // Delete service detail
    });
});

    // About Page CRUD
    Route::prefix('about')->group(function () {
        Route::get('create', [AboutController::class, 'create'])->name('about.create');
        Route::post('/', [AboutController::class, 'store'])->name('about.store');
        Route::get('{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('{id}', [AboutController::class, 'update'])->name('about.update');
        Route::delete('{id}', [AboutController::class, 'destroy'])->name('about.delete');
    });

    // Contact Page CRUD
    Route::prefix('contact')->group(function () {
        Route::get('create', [ContactController::class, 'create'])->name('contact.create');
        Route::post('/', [ContactController::class, 'store'])->name('contact.store');
        Route::get('{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('{id}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('{id}', [ContactController::class, 'destroy'])->name('contact.delete');
    });
});
