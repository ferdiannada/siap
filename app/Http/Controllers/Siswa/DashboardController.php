<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Aspirasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        return view('siswa.dashboard', [
            'total' => Aspirasi::where('user_id', $userId)->count(),
            'menunggu' => Aspirasi::where('user_id', $userId)->where('status', 'menunggu')->count(),
            'diproses' => Aspirasi::where('user_id', $userId)->where('status', 'diproses')->count(),
            'selesai' => Aspirasi::where('user_id', $userId)->where('status', 'selesai')->count(),
        ]);
    }
}
