<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function importForm()
    {
        return view('admin.siswa.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));

            return back()->with('success', 'Data siswa berhasil diimport');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat import');
        }
    }

    public function resetPasswordForm()
    {
        $kelas = User::where('role', 'siswa')
            ->select('kelas')
            ->distinct()
            ->pluck('kelas');

        return view('admin.siswa.reset-password', compact('kelas'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'scope' => 'required|in:all,kelas',
            'kelas' => 'nullable',
        ]);

        $query = User::where('role', 'siswa');

        if ($request->scope === 'kelas') {
            $query->where('kelas', $request->kelas);
        }

        $count = $query->count();

        $query->update([
            'password' => Hash::make('password123'),
        ]);

        return back()->with('success',
            "Password berhasil direset untuk {$count} siswa."
        );
    }
}
