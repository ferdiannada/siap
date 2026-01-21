@extends('layouts.app')
@section('title','Reset Password Siswa')

@section('content')
<div class="fade-slide">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-shield-lock-fill text-danger"></i>
        Reset Password Massal Siswa
    </h4>

    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle-fill"></i>
        Password siswa akan direset menjadi:
        <strong>password123</strong>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="/admin/siswa/reset-password"
                  onsubmit="return confirm('Yakin reset password siswa?')">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Reset Berdasarkan
                    </label>

                    <select name="scope" class="form-select"
                            id="scopeSelect">
                        <option value="all">Semua Siswa</option>
                        <option value="kelas">Per Kelas</option>
                    </select>
                </div>

                <div class="mb-3 d-none" id="kelasWrapper">
                    <label class="form-label fw-semibold">
                        Pilih Kelas
                    </label>
                    <select name="kelas" class="form-select">
                        @foreach($kelas as $k)
                            <option value="{{ $k }}">{{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger">
                        <i class="bi bi-arrow-repeat"></i>
                        Reset Password
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.getElementById('scopeSelect')
    .addEventListener('change', function () {
        document.getElementById('kelasWrapper')
            .classList.toggle('d-none', this.value !== 'kelas');
    });
</script>
@endpush
