<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CounterController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get("/chatting",[ChatController::class,"index"])->name('chat.view');
Route::get("/chat",[ChatController::class,"getMsg"])->name('chatting.view');
Route::post("/chat",[ChatController::class,"sendPesan"])->name('chat.post');
Route::get("/user",[ChatController::class,"getUserLogin"]);
Route::get("/",[CounterController::class,"index"]);

Route::delete("/delete",[ChatController::class,"destroy"]);

require __DIR__.'/auth.php';
