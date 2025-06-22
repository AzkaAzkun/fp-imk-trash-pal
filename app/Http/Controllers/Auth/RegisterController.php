<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nameInput' => 'required|string|max:255',
            'emailInput' => 'required|email|unique:user,email',
            'phoneInput' => 'required|string',
            'passwordInput' => 'required|min:6',
        ]);
        // dd($request->all());
        // Ambil datanya
        $name = $request->input('nameInput');
        $email = $request->input('emailInput');
        $phone = $request->input('phoneInput');
        $password = bcrypt($request->input('passwordInput'));

        // Contoh simpan ke database
        User::create([
            'nama' => $name,
            'email' => $email,
            'nomor_telepon' => $phone,
            'password' => $password,
            'role' => 'user',
        ]);

        // Redirect atau response sukses
        return redirect()->route('home')->with('success', 'Berhasil mendaftar!');
    }
}
