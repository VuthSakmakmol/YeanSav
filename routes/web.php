<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Authentication routes (only logged-in users)
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

    //home page
    Route::get('/home/create', [HomeController::class, 'create'])->name('home.create');
    Route::post('/home', [HomeController::class, 'store'])->name('home.store');
    Route::get('/home/{id}/edit', [HomeController::class, 'edit'])->name('home.edit');
    Route::put('/home/{id}', [HomeController::class, 'update'])->name('home.update');
    Route::delete('/home/{id}', [HomeController::class, 'destroy'])->name('home.delete');

    //Service page
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.delete');

    //About page
    Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');
    Route::post('/about', [AboutController::class, 'store'])->name('about.store');
    Route::get('/about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/{id}', [AboutController::class, 'update'])->name('about.update');
    Route::delete('/about/{id}', [AboutController::class, 'destroy'])->name('about.delete');

});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/service', [ServiceController::class, 'index'])->name('service');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/work', [AboutController::class, 'index'])->name('work');
Route::get('/contact', [AboutController::class, 'index'])->name('contact');



// Authentication routes setup (from Laravel Breeze or similar package)
require __DIR__.'/auth.php';
