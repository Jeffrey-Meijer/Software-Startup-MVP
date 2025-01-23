<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelAgencyController;


Route::get('/', [DestinationController::class, 'index'])->name('home'); // Gebruik hier de controller voor de bestemmingen

// Dashboard route
Route::get('/dashboard', function () {
    $destinations = App\Models\Destination::all();  // Fetch all destinations
    return view('dashboard', compact('destinations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
    Route::post('/travel-agency', [TravelAgencyController::class, 'store'])->name('travel-agency.store');
});
// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';