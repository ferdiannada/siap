@extends('layouts.app')
@section('title','Edit Kategori')

@section('content')
<div class="fade-slide">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-pencil-fill text-warning"></i>
        Edit Kategori
    </h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="/admin/categories/{{ $category->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $category->nama) }}">

                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="/admin/categories" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button class="btn btn-warning">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection