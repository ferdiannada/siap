<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\AspirasiHistory;
use App\Models\AspirasiProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function show($id)
    {
        $aspirasi = Aspirasi::with([
            'user',
            'category',
            'feedback',
            'progress',
            'histories.admin',
        ])->findOrFail($id);

        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        $statusLama = $aspirasi->status;
        $statusBaru = $request->status;

        // Jika status sama, tidak perlu update
        if ($statusLama === $statusBaru) {
            return back()->with('info', 'Status tidak berubah.');
        }

        // Update status aspirasi
        $aspirasi->update([
            'status' => $statusBaru,
        ]);

        // Simpan ke histori otomatis
        AspirasiHistory::create([
            'aspirasi_id' => $aspirasi->id,
            'status_lama' => $statusLama,
            'status_baru' => $statusBaru,
            'admin_id' => Auth::id(),
        ]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function addProgress(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|min:5',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        AspirasiProgress::create([
            'aspirasi_id' => $aspirasi->id,
            'keterangan' => $request->keterangan,
        ]);

        // Jika masih menunggu, ubah jadi diproses + simpan histori
        if ($aspirasi->status === 'menunggu') {
            $statusLama = $aspirasi->status;
            $aspirasi->update(['status' => 'diproses']);

            AspirasiHistory::create([
                'aspirasi_id' => $aspirasi->id,
                'status_lama' => $statusLama,
                'status_baru' => 'diproses',
                'admin_id' => Auth::id(),
            ]);
        }

        return back()->with('success', 'Progres berhasil ditambahkan.');
    }
}
