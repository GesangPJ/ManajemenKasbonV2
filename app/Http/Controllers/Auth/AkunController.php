<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AkunController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Akun::class],
            'password' => ['required'],
            'is_admin'=>['required'],
        ]);

        Akun::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin'=>$request->is_admin,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/pendaftaran')->with('success','Akun berhasil ditambahkan');
    }
}
