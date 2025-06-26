<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserPenjemputan;
use Illuminate\Http\Request;

class PenjemputanController extends Controller
{
    public function approve($id)
    {
        $penjemputan = UserPenjemputan::findOrFail($id);
        $penjemputan->status = 'selesai';
        $penjemputan->save();

        return redirect()->back()->with('success', 'Penjemputan disetujui.');
    }

    public function progress($id)
    {
        $penjemputan = UserPenjemputan::findOrFail($id);
        $penjemputan->status = 'diproses';
        $penjemputan->save();

        return redirect()->back()->with('success', 'Penjemputan diproses.');
    }

    public function reject($id)
    {
        $penjemputan = UserPenjemputan::findOrFail($id);
        $penjemputan->status = 'ditolak';
        $penjemputan->save();

        return redirect()->back()->with('success', 'Penjemputan ditolak.');
    }
}
