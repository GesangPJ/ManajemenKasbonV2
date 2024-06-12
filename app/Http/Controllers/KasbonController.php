<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\KasbonRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\KasbonBayarRequest;
use App\Http\Requests\KasbonUpdateRequest;

class KasbonController extends Controller
{
    // Fungsi menyimpan data kasbon
    public function store(KasbonRequest $request): RedirectResponse
    {
        // Ambil data dari input
        $validatedData = $request->validated();

        // Tambahkan user_id dari session
        $validatedData['user_id'] = Auth::id();
        $validatedData['status_r'] = 'belum';
        $validatedData['status_b'] = 'belum';

        // Buat Data Kasbon
        Kasbon::create($validatedData);

        return redirect('/request-kasbon')->with('success', 'Permintaan Kasbon Berhasil Dikirim');
    }

    // Fungsi update status request (ubah status ke setuju/tolak)
    public function update_status_r(Request $request, $kasbonId): RedirectResponse
{
    // validasi input
    $request->validate([
        'status' => 'required|string|in:setuju,tolak',
    ]);

    // Cari id kasbon
    $kasbon = Kasbon::findOrFail($kasbonId);

    // Update status_r
    $kasbon->status_r = $request->status;

    // Masukkan id dari session
    $kasbon->admin_id = Auth::id();

    // Simpan
    $kasbon->save();

    // Kembali ke view dan kirim pesan success untuk alert
    return redirect('/admin-request')->with('success', 'Status Request Berhasil Diubah');
}

    // Fungsi update status bayar (ubah status ke belum/lunas)
    public function update_status_b(Request $request, $kasbonId): RedirectResponse
    {
    // Validasi input
    $request->validate([
        'status' => 'required|string|in:lunas,belum',
    ]);

    // Cari data sesuai id
    $kasbon = Kasbon::findOrFail($kasbonId);

    // Update status_b
    $kasbon->status_b = $request->status;

    // Tambahkan id sesuai yang ada di session
    $kasbon->admin_id = Auth::id();

    //Simpan
    $kasbon->save();

    // Kembali ke view dan kirim pesan success untuk alert
    return redirect('/admin-bayar')->with('success', 'Status Bayar Berhasil Diubah');
    }

}
