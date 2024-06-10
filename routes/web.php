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
    // Get all kasbon views
    $viewkasbon = Kasbonview::all();

    // Get kasbon views for the logged-in user
    $kasbonkaryawan = Kasbonview::viewKaryawan();

    // Get the sum results
    $kasbonSums = Kasbonview::jumlahTotalKasbon();

    // Pass the data to the view
    return view('dashboard', [
        'viewkasbon' => $viewkasbon,
        'kasbonkaryawan' => $kasbonkaryawan,
        'kasbonSums' => $kasbonSums,
    ]);
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
})->middleware(['auth','verified']);

Route::get('/admin-request', function(){
    return view('admin.viewrequest', ['requestkasbon'=>Kasbonview::viewRequest()]);
})->middleware(['auth', 'verified','admin'])->name('admin-request');

Route::get('/admin-bayar', function(){
    return view('admin.viewbayar', ['bayarkasbon'=>Kasbonview::viewBayar()]);
})->middleware(['auth', 'verified', 'admin'])->name('admin-bayar');


require __DIR__.'/auth.php';


