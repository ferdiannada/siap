@extends('layouts.app')
@section('title','Detail Aspirasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-file-earmark-text-fill text-primary"></i>
                Detail Aspirasi
            </h4>
            <p class="text-muted mb-0">
                Informasi lengkap laporan aspirasi siswa
            </p>
        </div>

        <a href="/admin/aspirasi" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- STATUS BIG -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h6 class="text-muted mb-1">Status Aspirasi</h6>
                <span class="badge-status fs-6
                    {{ $aspirasi->status=='menunggu' ? 'bg-warning' :
                       ($aspirasi->status=='diproses' ? 'bg-info' : 'bg-success') }}">
                    <i class="bi
                        {{ $aspirasi->status=='menunggu' ? 'bi-hourglass-split' :
                           ($aspirasi->status=='diproses' ? 'bi-gear-fill' : 'bi-check-circle-fill') }}">
                    </i>
                    {{ ucfirst($aspirasi->status) }}
                </span>
            </div>

            <div class="text-muted">
                <i class="bi bi-clock"></i>
                {{ $aspirasi->created_at->format('d M Y, H:i') }}
            </div>

        </div>
    </div>

    <div class="row g-4">

        <!-- LEFT -->
        <div class="col-md-8">

            <!-- INFO SISWA -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-person-fill text-primary"></i>
                        Informasi Siswa
                    </h6>

                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="150">Nama</td>
                            <td>: <strong>{{ $aspirasi->user->name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: {{ $aspirasi->user->kelas }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $aspirasi->user->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- DETAIL ASPIRASI -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-chat-left-text-fill text-success"></i>
                        Detail Aspirasi
                    </h6>

                    <div class="mb-3">
                        <span class="badge rounded-pill bg-secondary">
                            {{ $aspirasi->category->nama }}
                        </span>
                    </div>

                    <p class="mb-2">
                        <strong>Lokasi:</strong><br>
                        <i class="bi bi-geo-alt-fill text-danger"></i>
                        {{ $aspirasi->lokasi }}
                    </p>

                    <p class="mb-0">
                        <strong>Deskripsi:</strong><br>
                        {{ $aspirasi->deskripsi }}
                    </p>
                </div>
            </div>

            <!-- FOTO BUKTI -->
            @if($aspirasi->foto)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-camera-fill text-info"></i>
                        Foto Bukti
                    </h6>

                    <img src="{{ asset('storage/'.$aspirasi->foto) }}" class="img-fluid rounded zoom-img"
                        style="max-height:350px">
                </div>
            </div>
            @endif

        </div>

        <!-- RIGHT -->
        <div class="col-md-4">

            <!-- UPDATE STATUS -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-arrow-repeat text-primary"></i>
                        Ubah Status
                    </h6>

                    <form action="/admin/aspirasi/{{ $aspirasi->id }}/status" method="POST">
                        @csrf

                        <select name="status" class="form-select mb-3">
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

                        <button class="btn btn-primary w-100">
                            <i class="bi bi-save-fill"></i>
                            Simpan Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- FEEDBACK -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-chat-dots-fill text-success"></i>
                        Feedback Admin
                    </h6>

                    <form action="/admin/aspirasi/{{ $aspirasi->id }}/feedback" method="POST">
                        @csrf
                        <textarea name="feedback" class="form-control mb-3" rows="4"
                            placeholder="Tulis feedback untuk siswa...">{{ $aspirasi->feedback }}</textarea>

                        <button class="btn btn-success w-100">
                            <i class="bi bi-send-fill"></i>
                            Kirim Feedback
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection