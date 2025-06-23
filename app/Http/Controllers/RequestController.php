<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPenjemputan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserPenjemputanEnum;

class RequestController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'bankSampahInput' => 'required|string|exists:user,id',
            'tanggalPenjemputanInput' => 'required|date',
            'alamatPenjemputanInput' => 'required|string',
            'volumeInput' => 'required|numeric',
        ]);

        // Generate nomor invoice (contoh)
        $nomorInvoice = 'INV-' . strtoupper(uniqid());

        // Simpan ke database
        UserPenjemputan::create([
            'bank_sampah_id' => $request->input('bankSampahInput'),
            'tanggal_penjemputan' => $request->input('tanggalPenjemputanInput'),
            'alamat_penjemputan' => $request->input('alamatPenjemputanInput'),
            'volume' => $request->input('volumeInput'),
            'status' => UserPenjemputanEnum::Menunggu, // default status
            'nomor_invoice' => $nomorInvoice,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Permintaan penjemputan berhasil dikirim!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'penjemputan_id' => 'required|exists:user_penjemputan,id',
            'status' => 'required|in:dibatalkan',
        ]);

        $penjemputan = UserPenjemputan::findOrFail($request->penjemputan_id);
        $penjemputan->status = $request->status;
        $penjemputan->save();

        return redirect()->back()->with('success', 'Penjemputan berhasil dibatalkan.');
    }
}
