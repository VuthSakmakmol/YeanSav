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

   Route::middleware(['auth', 'admin'])->group(function () {
       Route::get('/admin', [PageController::class, 'adminPanel'])->name('admin.panel');
       Route::post('/update-page', [PageController::class, 'updatePage'])->name('admin.updatePage');
   });
