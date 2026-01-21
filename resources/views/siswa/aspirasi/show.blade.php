@extends('layouts.app')
@section('title','Detail Aspirasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-file-earmark-text-fill text-primary"></i>
            Detail Aspirasi Saya
        </h4>
        <p class="text-muted">
            Pantau status, timeline, dan feedback dari pihak sekolah
        </p>
    </div>

    <!-- INFO & STATUS -->
    <div class="card shadow-sm hover-card mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="mb-1">
                        <i class="bi bi-tags-fill text-primary"></i>
                        <b>Kategori:</b> {{ $aspirasi->category->nama }}
                    </p>
                    <p class="mb-1">
                        <i class="bi bi-geo-alt-fill text-danger"></i>
                        <b>Lokasi:</b> {{ $aspirasi->lokasi }}
                    </p>
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-clock-history"></i>
                        Dikirim: {{ $aspirasi->created_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <span class="badge-status
                        {{ $aspirasi->status == 'menunggu' ? 'bg-warning' :
                           ($aspirasi->status == 'diproses' ? 'bg-info' : 'bg-success') }}">
                        <i class="bi
                            {{ $aspirasi->status == 'menunggu' ? 'bi-hourglass-split' :
                               ($aspirasi->status == 'diproses' ? 'bi-gear-fill' : 'bi-check-circle-fill') }}">
                        </i>
                        {{ strtoupper($aspirasi->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- STEPPER STATUS -->
    @php
    $steps = ['menunggu', 'diproses', 'selesai'];
    $currentIndex = array_search($aspirasi->status, $steps);
    @endphp

    <div class="card shadow-sm hover-card mb-3">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-diagram-3-fill text-primary"></i>
            Progress Aspirasi
        </div>
        <div class="card-body">

            <div class="stepper-wrapper animated-stepper" data-current="{{ $currentIndex }}">

                @foreach($steps as $index => $step)
                <div class="stepper-item" data-step="{{ $index }}">

                    <div class="step-counter">
                        <i class="bi
                            {{ $step == 'menunggu' ? 'bi-hourglass-split' :
                               ($step == 'diproses' ? 'bi-gear-fill' : 'bi-check-circle-fill') }}">
                        </i>
                    </div>

                    <div class="step-name text-capitalize">
                        {{ $step }}
                    </div>
                </div>
                @endforeach

                <div class="stepper-progress"></div>
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
            <img src="{{ asset('storage/'.$aspirasi->foto) }}" class="img-fluid rounded shadow-sm zoom-img"
                style="max-height:280px" data-bs-toggle="modal" data-bs-target="#fotoModal">
            <p class="text-muted small mt-2">
                Klik gambar untuk memperbesar
            </p>
        </div>
    </div>
    @endif

    <!-- FEEDBACK ADMIN -->
    <div class="card shadow-sm hover-card mb-3">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-reply-fill text-success"></i>
            Feedback dari Sekolah
        </div>
        <div class="card-body">
            @if($aspirasi->feedback)
            <div class="alert alert-success mb-0">
                <i class="bi bi-info-circle-fill"></i>
                {{ $aspirasi->feedback->feedback }}
            </div>
            @else
            <div class="alert alert-secondary mb-0">
                <i class="bi bi-hourglass"></i>
                Belum ada feedback dari pihak sekolah.
            </div>
            @endif
        </div>
    </div>

    <!-- BUTTON -->
    <a href="/siswa/aspirasi" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

    const stepper = document.querySelector('.animated-stepper');
    if (!stepper) return;

    const current = parseInt(stepper.dataset.current);
    const items   = stepper.querySelectorAll('.stepper-item');
    const progress = stepper.querySelector('.stepper-progress');

    items.forEach((item, index) => {
        if (index < current) {
            item.classList.add('completed');
        }
        if (index === current) {
            item.classList.add('active');
        }
    });

    // HITUNG PANJANG PROGRESS
    const percentage = current / (items.length - 1) * 100;

    // DELAY KECIL BIAR ANIMASI TERASA
    setTimeout(() => {
        progress.style.width = percentage + '%';
    }, 300);

});
</script>
@endpush