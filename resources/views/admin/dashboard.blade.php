@extends('layouts.app')
@section('title','Dashboard Admin')

@section('content')
<div class="fade-slide">

    <!-- WELCOME -->
    <div class="card dashboard-welcome mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    👋 Selamat Datang, Admin
                </h4>
                <p class="mb-0 opacity-75">
                    Kelola dan pantau aspirasi sekolah secara real-time
                </p>
            </div>
            <i class="bi bi-shield-check fs-1 opacity-50"></i>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card stat-glass primary">
                <div class="card-body">
                    <i class="bi bi-clipboard-data"></i>
                    <h6>Total Aspirasi</h6>
                    <h3>{{ $totalAspirasi }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-glass warning">
                <div class="card-body">
                    <i class="bi bi-hourglass-split"></i>
                    <h6>Menunggu</h6>
                    <h3>{{ $menunggu }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-glass info">
                <div class="card-body">
                    <i class="bi bi-gear-fill"></i>
                    <h6>Diproses</h6>
                    <h3>{{ $diproses }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-glass success">
                <div class="card-body">
                    <i class="bi bi-check-circle-fill"></i>
                    <h6>Selesai</h6>
                    <h3>{{ $selesai }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- PROGRESS -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                Progress Aspirasi
            </h6>

            @php
            $total = max($totalAspirasi,1);
            @endphp

            <div class="mb-3">
                Menunggu
                <div class="progress">
                    <div class="progress-bar bg-warning" style="width: {{ $menunggu/$total*100 }}%">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                Diproses
                <div class="progress">
                    <div class="progress-bar bg-info" style="width: {{ $diproses/$total*100 }}%">
                    </div>
                </div>
            </div>

            <div>
                Selesai
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: {{ $selesai/$total*100 }}%">
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection