@extends('layouts.app')
@section('title','Dashboard Siswa')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">Dashboard Siswa</h4>
        <span class="text-muted">Ringkasan pengaduan Anda</span>
    </div>

    <!-- STATISTIK -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body text-center">
                    <i class="bi bi-list-task fs-1 text-primary"></i>
                    <h6 class="mt-2">Total Aspirasi</h6>
                    <h3 class="fw-bold">{{ $total }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body text-center">
                    <i class="bi bi-hourglass-split fs-1 text-warning"></i>
                    <h6 class="mt-2">Menunggu</h6>
                    <h3 class="fw-bold">{{ $menunggu }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body text-center">
                    <i class="bi bi-tools fs-1 text-info"></i>
                    <h6 class="mt-2">Diproses</h6>
                    <h3 class="fw-bold">{{ $diproses }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm stat-card">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle fs-1 text-success"></i>
                    <h6 class="mt-2">Selesai</h6>
                    <h3 class="fw-bold">{{ $selesai }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- QUICK ACTION -->
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm action-card">
                <div class="card-body text-center">
                    <i class="bi bi-pencil-square fs-1 text-primary"></i>
                    <h5 class="mt-2">Buat Aspirasi</h5>
                    <p class="text-muted small">Laporkan kerusakan sarana</p>
                    <a href="/siswa/aspirasi/create" class="btn btn-primary btn-sm">
                        Buat Sekarang
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm action-card">
                <div class="card-body text-center">
                    <i class="bi bi-folder-check fs-1 text-success"></i>
                    <h5 class="mt-2">Aspirasi Saya</h5>
                    <p class="text-muted small">Lihat semua laporan</p>
                    <a href="/siswa/aspirasi" class="btn btn-success btn-sm">
                        Lihat
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm action-card">
                <div class="card-body text-center">
                    <i class="bi bi-bell fs-1 text-warning"></i>
                    <h5 class="mt-2">Notifikasi</h5>
                    <p class="text-muted small">Status & feedback admin</p>
                    <a href="/siswa/notifikasi" class="btn btn-warning btn-sm">
                        Buka
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection