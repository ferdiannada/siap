@extends('layouts.app')
@section('title','Detail Aspirasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-clipboard-data text-primary"></i>
            Detail Aspirasi
        </h4>
        <p class="text-muted">Kelola laporan aspirasi siswa</p>
    </div>

    <!-- INFO ASPIRASI -->
    <div class="card shadow-sm hover-card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><i class="bi bi-person-fill"></i> <b>Siswa:</b> {{ $aspirasi->user->name }}</p>
                    <p><i class="bi bi-tags-fill"></i> <b>Kategori:</b> {{ $aspirasi->category->nama }}</p>
                </div>
                <div class="col-md-6">
                    <p><i class="bi bi-geo-alt-fill"></i> <b>Lokasi:</b> {{ $aspirasi->lokasi }}</p>
                    <p>
                        <i class="bi bi-flag-fill"></i> <b>Status Saat Ini:</b>
                        <span class="badge 
                            {{ $aspirasi->status=='menunggu'?'bg-warning':
                               ($aspirasi->status=='diproses'?'bg-info':'bg-success') }}">
                            {{ strtoupper($aspirasi->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="card shadow-sm hover-card mb-3">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-chat-left-text-fill text-success"></i>
            Deskripsi Aspirasi
        </div>
        <div class="card-body">
            {{ $aspirasi->deskripsi }}
        </div>
    </div>

    <!-- FOTO -->
    @if($aspirasi->foto)
    <div class="card shadow-sm hover-card mb-3">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-camera-fill text-info"></i>
            Foto Bukti Kerusakan
        </div>
        <div class="card-body text-center">
            <img src="{{ asset('storage/'.$aspirasi->foto) }}" class="img-fluid rounded zoom-img"
                style="max-height:300px" data-bs-toggle="modal" data-bs-target="#fotoModal">
            <p class="text-muted mt-2">Klik gambar untuk memperbesar</p>
        </div>
    </div>
    @endif

    <!-- FORM UBAH STATUS -->
    <div class="card shadow-sm hover-card mb-3">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-arrow-repeat text-warning"></i>
            Ubah Status Aspirasi
        </div>
        <div class="card-body">
            <form action="/admin/aspirasi/{{ $aspirasi->id }}/status" method="POST">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <select name="status" class="form-select">
                            <option value="menunggu" {{ $aspirasi->status=='menunggu'?'selected':'' }}>
                                Menunggu
                            </option>
                            <option value="diproses" {{ $aspirasi->status=='diproses'?'selected':'' }}>
                                Diproses
                            </option>
                            <option value="selesai" {{ $aspirasi->status=='selesai'?'selected':'' }}>
                                Selesai
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Status
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- FORM FEEDBACK -->
    <div class="card shadow-sm hover-card">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-send-fill text-success"></i>
            Feedback untuk Siswa
        </div>
        <div class="card-body">
            <form action="/admin/aspirasi/{{ $aspirasi->id }}/feedback" method="POST">
                @csrf
                <textarea name="feedback" rows="4" class="form-control mb-3"
                    placeholder="Tulis feedback untuk siswa...">{{ $aspirasi->feedback->feedback ?? '' }}</textarea>

                <button class="btn btn-success">
                    <i class="bi bi-check-circle"></i>
                    {{ $aspirasi->feedback ? 'Update Feedback' : 'Kirim Feedback' }}
                </button>
            </form>
        </div>
    </div>

</div>

<!-- MODAL FOTO -->
@if($aspirasi->foto)
<div class="modal fade" id="fotoModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-image"></i> Foto Bukti Kerusakan
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/'.$aspirasi->foto) }}" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
@endif
@endsection