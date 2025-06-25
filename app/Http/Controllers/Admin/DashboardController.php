<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPenjemputan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $requests = UserPenjemputan::with(['user', 'bank_sampah'])
            ->where('bank_sampah_id', Auth::user()->id)
            ->whereNotIn('status', ['selesai', 'ditolak'])
            ->latest()
            ->paginate(5);

        $riwayatRequests = UserPenjemputan::with(['user', 'bank_sampah'])
            ->where('bank_sampah_id', Auth::user()->id)
            ->whereIn('status', ['selesai', 'ditolak'])
            ->latest()
            ->paginate(5);

        return view('user.dashboard_admin', compact('requests', 'riwayatRequests'));
    }
}
