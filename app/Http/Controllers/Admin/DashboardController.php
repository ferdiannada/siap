<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspirasi::with(['user', 'category'])->latest();

        // Filter berdasarkan tanggal (Y-m-d)
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Filter berdasarkan bulan (Y-m)
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', date('m', strtotime($request->bulan)))
                ->whereYear('created_at', date('Y', strtotime($request->bulan)));
        }

        // Filter berdasarkan siswa
        if ($request->filled('siswa_id')) {
            $query->where('user_id', $request->siswa_id);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirasi = $query->paginate(10);

        $categories = Category::all();
        $siswas = User::where('role', 'siswa')->get();

        return view('admin.dashboard', compact('aspirasi', 'categories', 'siswas'));
    }

}
