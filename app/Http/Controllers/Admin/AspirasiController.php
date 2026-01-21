<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use App\Models\AspirasiHistory;
use App\Models\AspirasiFeedback;
use App\Models\AspirasiProgress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StatusAspirasiNotification;
use App\Notifications\FeedbackAspirasiNotification;

class AspirasiController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $aspirasi = Aspirasi::with(['user', 'category'])
            ->latest()
            ->paginate(10)
            ->through(function ($item) use ($now) {
                $item->is_new = $item->created_at->diffInHours($now) <= 24;
                return $item;
            });

        return view('admin.aspirasi.index', compact('aspirasi'));
    }
    public function show(Request $request, $id)
    {
        $aspirasi = Aspirasi::with([
            'user',
            'category',
            'feedback.admin',
            'progress',
            'histories.admin',
        ])->findOrFail($id);

        // 🔔 AUTO MARK NOTIFICATION AS READ
        if ($request->notif) {
            Auth::user()
                ->notifications()
                ->where('id', $request->notif)
                ->update(['read_at' => now()]);
        }

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

        if ($statusLama === $statusBaru) {
            return back()->with('info', 'Status tidak berubah.');
        }

        // Update status utama
        $aspirasi->update([
            'status' => $statusBaru,
        ]);

        // Simpan histori (UNTUK TIMELINE & LOG)
        AspirasiHistory::create([
            'aspirasi_id' => $aspirasi->id,
            'status_lama' => $statusLama,
            'status_baru' => $statusBaru,
            'admin_id' => Auth::id(),
        ]);

        // Kirim notifikasi ke siswa
        $aspirasi->user->notify(
            new StatusAspirasiNotification(
                $aspirasi,
                $statusLama,
                $statusBaru
            )
        );

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

    public function storeFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|min:5',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        AspirasiFeedback::updateOrCreate(
            [
                'aspirasi_id' => $aspirasi->id,
            ],
            [
                'admin_id' => Auth::id(),
                'feedback' => $request->feedback,
            ]
        );

        $aspirasi->user->notify(
            new FeedbackAspirasiNotification($aspirasi)
        );

        return back()->with('success', 'Feedback berhasil disimpan.');
    }
}
