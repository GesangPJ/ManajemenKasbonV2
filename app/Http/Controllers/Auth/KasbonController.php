<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\KasbonRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
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

        // Create the Kasbon record with the merged data
        Kasbon::create($validatedData);

        return redirect('/request-kasbon')->with('success', 'Permintaan Kasbon Telah Dikirim');
    }

    public function update_status_r(KasbonUpdateRequest $request, Kasbon $kasbon): RedirectResponse
    {
        $kasbon->update($request->validated());

        $kasbon = $request->kasbon();
        $kasbon->fill($request->validated());

        // Update status_r
        $kasbon->status_r = $request->status_r;


        // Insert session ID into admin_id field
        $kasbon->admin_id = $request->session()->get('id');

        $kasbon->save();

        return redirect('/admin-request')->with('success', 'Request Diubah');
    }

    public function update_status_b(KasbonUpdateRequest $request): RedirectResponse
    {
        $kasbon = $request->kasbon();
        $kasbon->fill($request->validated());

        // Update status_b
        $kasbon->status_b = $request->status_b;

        $kasbon->admin_id = $request->session()->get('id');

        $kasbon->save();

        return Redirect::route('status.bayar')->with('status', 'profile-updated');
    }
}
