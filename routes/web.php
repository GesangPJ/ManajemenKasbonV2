<?php

use App\Http\Controllers\KasbonController;
use App\Http\Controllers\ProfileController;
use App\Models\Kasbonview;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Halaman Home / Beranda
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard',['viewkasbon'=>Kasbonview::all(), 'kasbonkaryawan'=>Kasbonview::viewKaryawan()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/request-kasbon', function () {
    return view('karyawan.tambah');
})->middleware(['auth', 'verified'])->name('request-kasbon');

Route::get('/bayar-kasbon', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('bayar-kasbon');

Route::get('/detail/{kasbon:id}', function(Kasbonview $kasbon){
    return view('detail',['kasbon'=>$kasbon]);
});

Route::get('/admin-request', function(){
    return view('admin.viewrequest', ['requestkasbon'=>Kasbonview::viewRequest()]);
})->middleware(['auth', 'verified','admin'])->name('admin-request');

Route::get('/admin-bayar', function(){
    return view('admin.viewbayar', ['bayarkasbon'=>Kasbonview::viewBayar()]);
})->middleware(['auth', 'verified', 'admin'])->name('admin-bayar');


require __DIR__.'/auth.php';


