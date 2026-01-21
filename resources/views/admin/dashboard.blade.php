@extends('layouts.app')
@section('title','Dashboard Admin')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Dashboard Admin</h4>
        <span class="text-muted">Manajemen Aspirasi Sekolah</span>
    </div>

    <!-- STATISTIK -->
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <h6>Total Aspirasi</h6>
                    <h3>{{ $totalAspirasi }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-warning text-white">
                <div class="card-body">
                    <h6>Menunggu</h6>
                    <h3>{{ $menunggu }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-info text-white">
                <div class="card-body">
                    <h6>Diproses</h6>
                    <h3>{{ $diproses }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm bg-success text-white">
                <div class="card-body">
                    <h6>Selesai</h6>
                    <h3>{{ $selesai }}</h3>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('scripts')
<script>
    // Badge status dinamis
document.querySelectorAll('.status-badge').forEach(el => {
    const s = el.dataset.status;
    el.classList.add(
        s === 'menunggu' ? 'bg-warning' :
        s === 'diproses' ? 'bg-info' :
        'bg-success'
    );
});
</script>
@endpush