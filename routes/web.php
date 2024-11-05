<?php


use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/work', [PageController::class, 'work'])->name('work');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/panel', [PageController::class, 'adminPanel'])->name('admin.panel');
    Route::get('/admin/create', [PageController::class, 'createPage'])->name('admin.createPage');
    Route::post('/admin/store', [PageController::class, 'storePage'])->name('admin.storePage');
    Route::get('/admin/edit/{id}', [PageController::class, 'editPage'])->name('admin.editPage'); // Add this route
    Route::put('/admin/update/{id}', [PageController::class, 'updatePage'])->name('admin.updatePage');
    Route::delete('/admin/delete/{id}', [PageController::class, 'deletePage'])->name('admin.deletePage');
});
