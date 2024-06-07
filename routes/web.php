<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('request',function(){
    return view('requestkasbon',['halaman'=>'Request Kasbon']);
})->middleware(['auth', 'verified'])->name('request');

Route::get('bayar', function(){
    return view('bayarkasbon',['halaman'=>'Bayar Kasbon']);
})->middleware(['auth', 'verified'])->name('bayar');
