<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->get();

        return view('siswa.aspirasi.index', compact('aspirasi'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('siswa.aspirasi.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // === SIMPAN FOTO TEMPORARY ===
        if ($request->hasFile('foto')) {
            $tmpPath = $request->file('foto')->store('tmp', 'public');
            session(['tmp_foto' => $tmpPath]);
        }

        // SIMPAN DATA FINAL
        $fotoFinal = session('tmp_foto');

        Aspirasi::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoFinal,
            'status' => 'menunggu',
        ]);

        // HAPUS SESSION TMP
        session()->forget('tmp_foto');

        return redirect('/siswa/aspirasi')
            ->with('success', 'Aspirasi berhasil dikirim');

    }

    public function show($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->with(['category', 'feedback', 'progress'])
            ->findOrFail($id);

        return view('siswa.aspirasi.show', compact('aspirasi'));
    }

    public function edit($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())->findOrFail($id);

        if ($aspirasi->status !== 'menunggu') {
            return back()->withErrors('Aspirasi sudah diproses, tidak bisa diedit.');
        }

        $categories = Category::all();
        return view('siswa.aspirasi.edit', compact('aspirasi', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())->findOrFail($id);

        if ($aspirasi->status !== 'menunggu') {
            return back()->withErrors('Aspirasi sudah diproses, tidak bisa diubah.');
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $aspirasi->update([
            'category_id' => $request->category_id,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/siswa/aspirasi')->with('success', 'Aspirasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())->findOrFail($id);

        if ($aspirasi->status !== 'menunggu') {
            return back()->withErrors('Aspirasi sudah diproses, tidak bisa dihapus.');
        }

        $aspirasi->delete();

        return redirect('/siswa/aspirasi')->with('success', 'Aspirasi berhasil dihapus.');
    }
}
