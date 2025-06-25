<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'emailInput' => 'required|email|exists:user,email',
            'passwordInput' => 'required|min:6',
        ]);

        $credentials = [
            'email' => $request->input('emailInput'),
            'password' => $request->input('passwordInput'),
        ];

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

            return back()->withErrors([
                'emailInput' => 'Email atau password salah.',
            ])->withInput();

        } catch (\Exception $e) {
            return back()->withErrors([
                'emailInput' => 'Terjadi kesalahan saat mencoba login: ' . $e->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}
