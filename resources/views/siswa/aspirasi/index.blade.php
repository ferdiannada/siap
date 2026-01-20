@extends('layouts.app')
@section('title','Aspirasi Saya')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Aspirasi Saya</h4>
    <a href="/siswa/aspirasi/create" class="btn btn-primary">
        <i class="bi bi-plus"></i> Buat Aspirasi
    </a>
</div>

<table class="table table-hover">
    <thead class="table-light">
        <tr>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aspirasi as $a)
        <tr>
            <td>{{ $a->category->nama }}</td>
            <td>
                <span class="badge bg-info">{{ $a->status }}</span>
            </td>
            <td>
                <a href="/siswa/aspirasi/{{ $a->id }}" class="btn btn-sm btn-outline-primary">
                    Detail
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection