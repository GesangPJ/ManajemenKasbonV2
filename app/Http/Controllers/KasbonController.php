<?php

namespace App\Http\Controllers;

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

    public function update(KasbonUpdateRequest $request): RedirectResponse
    {
        $kasbon = $request->kasbon();
        $kasbon->fill($request->validated());

        // Update status_r and status_b
        $kasbon->status_r = $request->status_r;
        $kasbon->status_b = $request->status_b;

        // Insert session ID into admin_id field
        $kasbon->admin_id = $request->session()->get('id');

        $kasbon->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
