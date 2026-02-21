<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StaffController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    

    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');

    // Add New Staff Routes 
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');

    // Movie Routes
    Route::resource('movies', \App\Http\Controllers\Admin\MovieController::class);

    // Cinema Routes
    Route::resource('cinemas', \App\Http\Controllers\Admin\CinemaController::class);

    // Cinema Hall Routes
    Route::resource('cinema-halls', \App\Http\Controllers\Admin\CinemaHallController::class);

    // Seat Type Routes
    Route::resource('seat-types', \App\Http\Controllers\Admin\SeatTypeController::class);
    
});
// -------------------------------------------------------------



Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard'); 
    })->name('user.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';