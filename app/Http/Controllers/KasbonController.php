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
    /**
    public function request(Request $request): View
    {
        return view('kasbon.edit', [
            'kasbon' => $request->kasbon(),
        ]);
    }*/

    public function store(KasbonRequest $request): RedirectResponse
    {
        // Retrieve the validated input data
        $validatedData = $request->validated();

        // Add the user_id from the current session user
        $validatedData['user_id'] = Auth::id();
        $validatedData['status_r'] = 'belum';
        $validatedData['status_b'] = 'belum';

        // Create the Kasbon record with the merged data
        Kasbon::create($validatedData);

        return redirect('/request-kasbon')->with('success', 'Permintaan Kasbon Berhasil Dikirim');
    }

    public function update_status_r(Request $request, $kasbonId): RedirectResponse
{
    // Validate the request status input
    $request->validate([
        'status' => 'required|string|in:setuju,tolak',
    ]);

    // Find the Kasbon record by ID
    $kasbon = Kasbon::findOrFail($kasbonId);

    // Update status_r
    $kasbon->status_r = $request->status;

    // Insert session ID into admin_id field
    $kasbon->admin_id = Auth::id();

    $kasbon->save();

    return redirect('/admin-request')->with('success', 'Status Request Berhasil Diubah');
}


    public function update_status_b(Request $request, $kasbonId): RedirectResponse
    {
    // Validate the request status input
    $request->validate([
        'status' => 'required|string|in:lunas,belum',
    ]);

    // Find the Kasbon record by ID
    $kasbon = Kasbon::findOrFail($kasbonId);

    // Update status_r
    $kasbon->status_b = $request->status;

    // Insert session ID into admin_id field
    $kasbon->admin_id = Auth::id();

    $kasbon->save();

    return redirect('/admin-bayar')->with('success', 'Status Bayar Berhasil Diubah');
    }

}
