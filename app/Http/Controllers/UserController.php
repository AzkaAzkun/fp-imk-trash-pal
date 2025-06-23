<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::find(Auth::id());

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil && Storage::disk('public')->exists('foto_profil/' . $user->foto_profil)) {
                Storage::disk('public')->delete('foto_profil/' . $user->foto_profil);
            }

            // Simpan foto baru
            $file = $request->file('foto_profil');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('foto_profil', $filename, 'public');

            $user->foto_profil = $filename;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diubah!');
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nameInput' => 'required|string|max:255',
            'phoneInput' => 'required|string',
            'genderInput' => 'in:L,P',
        ]);

        $user = User::find(Auth::id());

        $user->nama = $request->nameInput;
        $user->nomor_telepon = $request->phoneInput;
        $user->jenis_kelamin = $request->genderInput;
        $user->alamat = $request->alamatInput;
        $user->tanggal_lahir = $request->tanggalLahirInput;

        $user->save();

        return back()->with('success', 'profil berhasil diubah!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
        }

        $user->password = bcrypt($request->new_password);

        if ($user) {
            $user->save();
            return back()->with('success', 'Password berhasil diperbarui.');
        } else {
            return back()->withErrors(['user' => 'User tidak ditemukan.']);
        }
    }
}
