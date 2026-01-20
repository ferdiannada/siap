@extends('layouts.app')
@section('title','Buat Aspirasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">Buat Aspirasi</h4>
        <span class="text-muted">Sampaikan keluhan atau laporan sarana sekolah</span>
    </div>

    <!-- CARD FORM -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form id="formAspirasi" action="/siswa/aspirasi" method="POST">
                @csrf

                <!-- KATEGORI -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Kategori Aspirasi
                    </label>
                    <select name="category_id" class="form-select select2" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- LOKASI -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Lokasi Kejadian
                    </label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Ruang Kelas X IPA 2"
                        required>
                </div>

                <!-- DESKRIPSI -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Deskripsi Aspirasi
                    </label>
                    <textarea name="deskripsi" class="form-control" rows="4"
                        placeholder="Jelaskan kondisi atau masalah secara singkat dan jelas" required></textarea>
                    <small class="text-muted">
                        Minimal 10 karakter
                    </small>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-end">
                    <a href="/siswa/aspirasi" class="btn btn-secondary me-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Kirim Aspirasi
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

    // Init Select2
    $('.select2').select2({
        theme: 'bootstrap-5',
        placeholder: 'Pilih kategori',
        width: '100%'
    });

    // Validasi & konfirmasi submit
    document.getElementById('formAspirasi').addEventListener('submit', function(e) {
        e.preventDefault();

        const deskripsi = document.querySelector('[name="deskripsi"]').value;

        if (deskripsi.length < 10) {
            Swal.fire({
                icon: 'warning',
                title: 'Deskripsi terlalu singkat',
                text: 'Mohon jelaskan aspirasi minimal 10 karakter'
            });
            return;
        }

        Swal.fire({
            title: 'Kirim Aspirasi?',
            text: 'Pastikan data yang Anda masukkan sudah benar',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirim',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });

});
</script>
@endpush