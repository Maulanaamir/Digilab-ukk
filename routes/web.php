<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController; 
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        # code... ini biar kalo si atmin😹 login otomatis ke halaman dia. nyoba ke route untuk user otomatis di tendang.😸
        return redirect()->route('dashboard');
    }
    return view('welcome'); 
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route Profile Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('books', BookController::class)->only(['index', 'show']);

    Route::middleware([IsAdmin::class])->group(function () {
        
        Route::resource('books', BookController::class)->except(['index', 'show']);
        
        
        
    });
});

require __DIR__.'/auth.php';