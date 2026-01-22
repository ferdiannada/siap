@extends('layouts.app')
@section('title','Aspirasi Saya')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="dashboard-welcome p-4 mb-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-pencil-square"></i>
                    Aspirasi Saya
                </h4>
                <p class="mb-0 opacity-75">
                    Riwayat laporan sarana yang telah kamu kirim
                </p>
            </div>

            <a href="/siswa/aspirasi/create" class="btn btn-light mt-3 mt-md-0">
                <i class="bi bi-plus-circle-fill"></i>
                Buat Aspirasi
            </a>
        </div>
    </div>

    <!-- FILTER STATUS -->
    <form method="GET" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-4 col-lg-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">🔎 Semua Status</option>
                    <option value="menunggu" {{ request('status')=='menunggu' ? 'selected' : '' }}>
                        ⏳ Menunggu
                    </option>
                    <option value="diproses" {{ request('status')=='diproses' ? 'selected' : '' }}>
                        ⚙️ Diproses
                    </option>
                    <option value="selesai" {{ request('status')=='selesai' ? 'selected' : '' }}>
                        ✅ Selesai
                    </option>
                </select>
            </div>

            @if(request('status'))
            <div class="col-auto">
                <a href="/siswa/aspirasi" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i>
                    Reset
                </a>
            </div>
            @endif
        </div>
    </form>


    <!-- LIST ASPIRASI -->
    <div class="row g-4">

        @forelse($aspirasi as $a)
        <div class="col-md-6 col-lg-4">

            <div class="card aspirasi-card shadow-sm h-100">

                <div class="card-body d-flex flex-column">

                    <!-- TOP INFO -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge rounded-pill bg-secondary">
                            <i class="bi bi-tags-fill"></i>
                            {{ $a->category->nama }}
                        </span>

                        <span class="badge-status
                            {{ $a->status=='menunggu' ? 'bg-warning' :
                               ($a->status=='diproses' ? 'bg-info' : 'bg-success') }}">
                            <i class="bi
                                {{ $a->status=='menunggu' ? 'bi-hourglass-split' :
                                   ($a->status=='diproses' ? 'bi-gear-fill' : 'bi-check-circle-fill') }}">
                            </i>
                            {{ ucfirst($a->status) }}
                        </span>
                    </div>

                    <!-- DESKRIPSI + DOT BARU -->
                    <h6 class="fw-semibold mb-2 d-flex align-items-center">
                        {{ Str::limit($a->deskripsi, 90) }}

                        @if($a->is_new)
                        <span class="ms-1 text-danger" title="Aspirasi baru">
                            <i class="bi bi-dot fs-3"></i>
                        </span>
                        @endif
                    </h6>

                    <!-- LOKASI -->
                    <p class="text-muted small mb-3">
                        <i class="bi bi-geo-alt-fill text-danger"></i>
                        {{ $a->lokasi }}
                    </p>

                    <!-- FOOTER CARD -->
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="bi bi-clock"></i>
                            {{ $a->created_at->diffForHumans() }}
                        </small>

                        <a href="/siswa/aspirasi/{{ $a->id }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                            Detail
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @empty

        <!-- EMPTY STATE -->
        <div class="col-12">
            <div class="text-center text-muted py-5">
                <i class="bi bi-inbox fs-1 mb-3"></i>
                <h6 class="fw-semibold">Belum Ada Aspirasi</h6>
                <p class="mb-3">
                    Kamu belum pernah mengirim laporan sarana
                </p>
                <a href="/siswa/aspirasi/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i>
                    Buat Aspirasi Pertama
                </a>
            </div>
        </div>

        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $aspirasi->links() }}
    </div>

</div>
@endsection