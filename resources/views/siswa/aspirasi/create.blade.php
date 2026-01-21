@extends('layouts.app')
@section('title','Buat Aspirasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            <i class="bi bi-pencil-square text-primary"></i>
            Buat Aspirasi
        </h4>
        <p class="text-muted mb-0">
            Laporkan kerusakan atau permasalahan sarana sekolah dengan jelas
        </p>
    </div>

    <!-- GLOBAL ERROR -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle-fill"></i>
        Periksa kembali input yang Anda masukkan
    </div>
    @endif

    <div class="row g-4">

        <!-- FORM -->
        <div class="col-md-8">
            <div class="card shadow-sm hover-card">
                <div class="card-body">

                    <form id="formAspirasi" action="/siswa/aspirasi" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- KATEGORI -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-tags-fill text-primary"></i>
                                Kategori Aspirasi
                            </label>

                            <select name="category_id" class="form-select select2
                                    @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $c)
                                <option value="{{ $c->id }}" {{ old('category_id')==$c->id ? 'selected' : '' }}>
                                    {{ $c->nama }}
                                </option>
                                @endforeach
                            </select>

                            @error('category_id')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- LOKASI -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                Lokasi Kejadian
                            </label>

                            <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                class="form-control @error('lokasi') is-invalid @enderror"
                                placeholder="Contoh: Ruang Kelas X IPA 2">

                            @error('lokasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-chat-left-text-fill text-success"></i>
                                Deskripsi Aspirasi
                            </label>

                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Jelaskan permasalahan secara jelas dan detail">{{ old('deskripsi') }}</textarea>

                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted">
                                    Minimal 10 karakter
                                </small>
                                <small id="charCount" class="text-muted">
                                    {{ strlen(old('deskripsi','')) }} karakter
                                </small>
                            </div>

                            @error('deskripsi')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- FOTO -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-camera-fill text-info"></i>
                                Foto Bukti (Opsional)
                            </label>

                            <input type="file" name="foto" id="fotoInput"
                                class="form-control @error('foto') is-invalid @enderror" accept="image/*">

                            <small class="text-muted">
                                JPG / PNG • Maksimal 2MB
                            </small>

                            @error('foto')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror

                            <!-- PREVIEW -->
                            <div class="mt-3 d-none" id="previewWrapper">
                                <p class="fw-semibold mb-1">Preview Foto</p>
                                <img id="fotoPreview" class="img-thumbnail zoom-img" style="max-height:220px">
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex justify-content-end">
                            <a href="/siswa/aspirasi" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send-fill"></i>
                                Kirim Aspirasi
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- SIDE INFO -->
        <div class="col-md-4">
            <div class="card shadow-sm hover-card">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-info-circle-fill text-primary"></i>
                        Tips Mengisi Aspirasi
                    </h6>

                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            Pilih kategori sesuai masalah
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            Tulis lokasi secara spesifik
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            Jelaskan kerusakan dengan jelas
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-success"></i>
                            Upload foto jika memungkinkan
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

    // SELECT2
    $('.select2').select2({
        width: '100%',
        placeholder: 'Pilih kategori'
    });

    // COUNTER DESKRIPSI
    const textarea = document.getElementById('deskripsi');
    const counter  = document.getElementById('charCount');

    textarea.addEventListener('input', function () {
        counter.textContent = this.value.length + ' karakter';
    });

    // PREVIEW FOTO
    $('#fotoInput').on('change', function () {
        const file = this.files[0];
        if (!file) return;

        if (file.size > 2048 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Ukuran file terlalu besar',
                text: 'Maksimal 2MB'
            });
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            $('#fotoPreview').attr('src', e.target.result);
            $('#previewWrapper').removeClass('d-none');
        };
        reader.readAsDataURL(file);
    });

    // SWEETALERT CONFIRM
    $('#formAspirasi').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Kirim Aspirasi?',
            text: 'Pastikan data yang kamu isi sudah benar',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirim',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

});
</script>
@endpush