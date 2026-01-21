@extends('layouts.app')
@section('title','Dashboard Siswa')

@section('content')
<div class="fade-slide">

    <!-- WELCOME -->
    <div class="card dashboard-welcome mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    👋 Halo, {{ auth()->user()->name }}
                </h4>
                <p class="mb-0 opacity-75">
                    Pantau aspirasi yang sudah kamu kirim
                </p>
            </div>
            <i class="bi bi-person-circle fs-1 opacity-50"></i>
        </div>
    </div>

    <!-- STAT -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card stat-glass primary">
                <div class="card-body">
                    <i class="bi bi-send-fill"></i>
                    <h6>Aspirasi Saya</h6>
                    <h3>{{ $total }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-glass info">
                <div class="card-body">
                    <i class="bi bi-gear-fill"></i>
                    <h6>Diproses</h6>
                    <h3>{{ $diproses }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-glass success">
                <div class="card-body">
                    <i class="bi bi-check-circle-fill"></i>
                    <h6>Selesai</h6>
                    <h3>{{ $selesai }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- QUICK ACTION -->
    <div class="row g-3">
        <div class="col-md-6">
            <a href="/siswa/aspirasi/create" class="card hover-card text-decoration-none">
                <div class="card-body">
                    <i class="bi bi-plus-circle-fill fs-3 text-primary"></i>
                    <h5 class="mt-2">Buat Aspirasi Baru</h5>
                    <p class="text-muted mb-0">
                        Laporkan kerusakan sarana sekolah
                    </p>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="/siswa/aspirasi" class="card hover-card text-decoration-none">
                <div class="card-body">
                    <i class="bi bi-list-check fs-3 text-success"></i>
                    <h5 class="mt-2">Lihat Aspirasi Saya</h5>
                    <p class="text-muted mb-0">
                        Pantau status & feedback
                    </p>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection