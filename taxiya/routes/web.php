<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Trajet Routes (Public Search)
Route::get('/trajets', [TrajetController::class, 'index'])->name('trajets.index');
Route::get('/trajets/{trajet}', [TrajetController::class, 'show'])->name('trajets.show');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Voyageur Routes
    Route::post('/trajets/{trajet}/book', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/mes-reservations', [ReservationController::class, 'index'])->name('reservations.index');

    // Chauffeur Routes (Basic check, middleware logic can be improved later)
    Route::get('/trajet/nouveau', [TrajetController::class, 'create'])->name('trajets.create');
    Route::post('/trajets', [TrajetController::class, 'store'])->name('trajets.store');
});