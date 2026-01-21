@extends('layouts.app')
@section('title','Aspirasi Saya')

@section('content')
<div class="fade-slide">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold">
                <i class="bi bi-pencil-square text-primary"></i>
                Aspirasi Saya
            </h4>
            <p class="text-muted mb-0">
                Riwayat laporan yang telah kamu kirim
            </p>
        </div>

        <a href="/siswa/aspirasi/create" class="btn btn-primary">
            <i class="bi bi-plus-circle-fill"></i>
            Buat Aspirasi
        </a>
    </div>

    <div class="row g-3">
        @forelse($aspirasi as $a)
        <div class="col-md-6">
            <div class="card hover-card h-100 position-relative {{ $a->is_new ? 'aspirasi-new' : '' }}">

                @if($a->is_new)
                <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                    Baru
                </span>
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge rounded-pill bg-secondary">
                            {{ $a->category->nama }}
                        </span>

                        <span class="badge-status
                            {{ $a->status=='menunggu' ? 'bg-warning' :
                               ($a->status=='diproses' ? 'bg-info' : 'bg-success') }}">
                            {{ ucfirst($a->status) }}
                        </span>
                    </div>

                    <h6 class="fw-semibold">
                        {{ Str::limit($a->deskripsi, 80) }}
                    </h6>

                    <small class="text-muted">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ $a->lokasi }}
                    </small>

                    <div class="d-flex justify-content-between mt-3">
                        <small class="text-muted">
                            {{ $a->created_at->diffForHumans() }}
                        </small>

                        <a href="/siswa/aspirasi/{{ $a->id }}" class="btn btn-sm btn-outline-primary">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            Belum ada aspirasi
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $aspirasi->links() }}
    </div>

</div>
@endsection