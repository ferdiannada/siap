@extends('layouts.app')
@section('title', 'Detail Aspirasi')

@section('content')

<div class="card mb-3">
    <div class="card-header bg-primary text-white">Informasi Aspirasi</div>
    <div class="card-body">
        <p><b>Kategori:</b> {{ $aspirasi->category->nama }}</p>
        <p><b>Lokasi:</b> {{ $aspirasi->lokasi }}</p>
        <p><b>Status:</b>
            <span class="badge bg-info">{{ $aspirasi->status }}</span>
        </p>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">Ubah Status</div>
    <div class="card-body">
        <form method="POST" action="/admin/aspirasi/{{ $aspirasi->id }}/status">
            @csrf
            <div class="row g-2">
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">Progres Perbaikan</div>
    <div class="card-body">
        <form method="POST" action="/admin/aspirasi/{{ $aspirasi->id }}/progress">
            @csrf
            <textarea class="form-control mb-2" name="keterangan"></textarea>
            <button class="btn btn-primary">Tambah Progres</button>
        </form>

        <ul class="list-group mt-3">
            @foreach($aspirasi->progress as $p)
            <li class="list-group-item">
                {{ $p->keterangan }}
                <small class="text-muted d-block">{{ $p->created_at }}</small>
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection