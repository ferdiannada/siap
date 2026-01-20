@extends('layouts.app')
@section('title','Detail Aspirasi')

@section('content')

<!-- INFORMASI -->
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <h5 class="fw-bold">Informasi Aspirasi</h5>
        <p><b>Kategori:</b> {{ $aspirasi->category->nama }}</p>
        <p><b>Lokasi:</b> {{ $aspirasi->lokasi }}</p>
        <p><b>Status:</b>
            <span class="badge bg-info">{{ $aspirasi->status }}</span>
            <button class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="modal" data-bs-target="#statusModal">
                Ubah
            </button>
        </p>
    </div>
</div>

<!-- MODAL STATUS -->
<div class="modal fade" id="statusModal">
    <div class="modal-dialog">
        <form method="POST" action="/admin/aspirasi/{{ $aspirasi->id }}/status" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <select name="status" class="form-select">
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- PROGRES -->
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <h5 class="fw-bold">Progres Perbaikan</h5>
        <form method="POST" action="/admin/aspirasi/{{ $aspirasi->id }}/progress">
            @csrf
            <textarea name="keterangan" class="form-control mb-2" placeholder="Tambah progres..." required></textarea>
            <button class="btn btn-primary">Tambah Progres</button>
        </form>

        <ul class="list-group mt-3">
            @foreach($aspirasi->progress as $p)
            <li class="list-group-item">
                {{ $p->keterangan }}
                <small class="text-muted d-block">{{ $p->created_at }}</small>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- FEEDBACK -->
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold">Feedback ke Siswa</h5>
        <form method="POST" action="/admin/aspirasi/{{ $aspirasi->id }}/feedback">
            @csrf
            <textarea name="feedback" class="form-control mb-2" required>
{{ $aspirasi->feedback->feedback ?? '' }}</textarea>
            <button class="btn btn-success">
                {{ $aspirasi->feedback ? 'Update Feedback' : 'Kirim Feedback' }}
            </button>
        </form>
    </div>
</div>

@endsection