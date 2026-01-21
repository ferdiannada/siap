@extends('layouts.app')
@section('title','Kategori Aspirasi')

@section('content')
<div class="fade-slide">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">
            <i class="bi bi-tags-fill text-primary"></i>
            Kategori Aspirasi
        </h4>

        <a href="/admin/categories/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
            </div>
            @endif

            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $i => $c)
                    <tr>
                        <td>{{ $categories->firstItem() + $i }}</td>
                        <td>{{ $c->nama }}</td>
                        <td>
                            <a href="/admin/categories/{{ $c->id }}/edit" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            @if($c->aspirasi_count > 0)
                            <button class="btn btn-sm btn-secondary" disabled title="Kategori sedang digunakan">
                                <i class="bi bi-lock-fill"></i>
                            </button>
                            @else
                            <form action="/admin/categories/{{ $c->id }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach


                    @if($categories->count() == 0)
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Belum ada kategori
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>

</div>
@endsection