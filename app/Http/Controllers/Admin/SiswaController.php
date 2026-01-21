<?php

namespace App\Http\Controllers\Admin;

use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
