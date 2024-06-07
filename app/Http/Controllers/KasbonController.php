<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\KasbonUpdateRequest;

class KasbonController extends Controller
{
    public function request(Request $request): View
    {
        return view('kasbon.edit', [
            'kasbon' => $request->kasbon(),
        ]);
    }

    public function TambahKasbon(Request $request): RedirectResponse
    {
        $kasbon = new Kasbon;
        $kasbon->user_id = $request->session()->get('id');
        $kasbon->jumlah = $request->jumlah;
        $kasbon->metode = $request->metode;
        $kasbon->keterangan = $request->keterangan;

        return redirect('/inputkasbon');
    }

    public function update_status_r(KasbonUpdateRequest $request): RedirectResponse
    {
        $kasbon = $request->kasbon();
        $kasbon->fill($request->validated());

        // Update status_r
        $kasbon->status_r = $request->status_r;


        // Insert session ID into admin_id field
        $kasbon->admin_id = $request->session()->get('id');

        $kasbon->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function update_status_b(KasbonUpdateRequest $request): RedirectResponse
    {
        $kasbon = $request->kasbon();
        $kasbon->fill($request->validated());

        // Update status_b
        $kasbon->status_b = $request->status_b;

        $kasbon->admin_id = $request->session()->get('id');

        $kasbon->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
