@extends('layouts.app')
@section('title','Import Data Siswa')

@section('content')
<div class="fade-slide">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-upload text-primary"></i>
        Import Data Siswa
    </h4>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle"></i>
        {{ session('error') }}
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="/admin/siswa/import" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        File Excel
                    </label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">

                    @error('file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    <small class="text-muted">
                        Format: .xls / .xlsx
                    </small>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        <i class="bi bi-upload"></i>
                        Import
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection