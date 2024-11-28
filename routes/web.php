<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDetailController;
use Illuminate\Support\Facades\Route;

// Public routes (accessible without login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/project', [ProjectController::class, 'index'])->name('project');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

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

    // Project CRUD
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('{project}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Project Detail CRUD
    Route::prefix('projects/{project}/details')->group(function () {
        Route::get('/', [ProjectDetailController::class, 'show'])->name('projectsdetails.show');  // Display project details
        Route::get('create', [ProjectDetailController::class, 'create'])->name('project.details.create'); // Create project details form
        Route::post('/', [ProjectDetailController::class, 'store'])->name('project.details.store'); // Store project details
        Route::get('{projectDetail}', [ProjectDetailController::class, 'show'])->name('project.details.show'); // Show specific project detail
        Route::get('{projectDetail}/edit', [ProjectDetailController::class, 'edit'])->name('project.details.edit'); // Edit project detail form
        Route::put('{projectDetail}', [ProjectDetailController::class, 'update'])->name('project.details.update'); // Update project detail
        Route::delete('{projectDetail}', [ProjectDetailController::class, 'destroy'])->name('project.details.destroy'); // Delete project detail
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
