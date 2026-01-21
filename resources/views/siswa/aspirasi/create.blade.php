@extends('layouts.app')
@section('title','Buat Aspirasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-pencil-square text-primary"></i>
            Buat Aspirasi
        </h4>
        <p class="text-muted">
            Laporkan kerusakan sarana sekolah dengan jelas dan lengkap
        </p>
    </div>

    <!-- ALERT ERROR GLOBAL -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Perhatian!</strong> Terdapat kesalahan pada input Anda.
    </div>
    @endif

    <!-- CARD FORM -->
    <div class="card shadow-sm aspirasi-card">
        <div class="card-body">

            <form id="formAspirasi" action="/siswa/aspirasi" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- KATEGORI -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-tags-fill text-primary"></i>
                        Kategori Aspirasi
                    </label>

                    <select name="category_id" class="form-select select2 @error('category_id') is-invalid @enderror">
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
                        placeholder="Jelaskan kerusakan atau masalah secara jelas">{{ old('deskripsi') }}</textarea>

                    <div class="d-flex justify-content-between">
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
                        Foto Bukti Kerusakan (Opsional)
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

                    <!-- PREVIEW (FILE BARU) -->
                    <div class="mt-3 d-none" id="previewWrapper">
                        <p class="fw-semibold mb-1">Preview Foto:</p>
                        <img id="fotoPreview" class="img-thumbnail" style="max-height:200px;">
                    </div>

                    <!-- PREVIEW (VALIDATION ERROR) -->
                    @if(session('tmp_foto'))
                    <div class="mt-3">
                        <p class="fw-semibold mb-1 text-warning">
                            Preview foto sebelumnya:
                        </p>
                        <img src="{{ asset('storage/'.session('tmp_foto')) }}" class="img-thumbnail"
                            style="max-height:200px;">
                        <small class="text-muted d-block mt-1">
                            *Silakan pilih ulang foto jika ingin mengganti
                        </small>
                    </div>
                    @endif
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
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

    // SELECT2 (AMAN + OLD VALUE)
    $('.select2').select2({
        width: '100%',
        placeholder: 'Pilih kategori'
    }).val("{{ old('category_id') }}").trigger('change');

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


    // SWEETALERT SUBMIT (ANTI DOUBLE SUBMIT)
    document.getElementById('formAspirasi')
        .addEventListener('submit', function (e) {

        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Kirim Aspirasi?',
            text: 'Pastikan data yang Anda isi sudah benar',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirim',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.querySelector('button[type=submit]').disabled = true;
                form.submit();
            }
        });
    });

});
</script>
@endpush