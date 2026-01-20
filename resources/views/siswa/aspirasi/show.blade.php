@extends('layouts.app')
@section('title','Detail Aspirasi')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold">Detail Aspirasi</h5>
        <p><b>Kategori:</b> {{ $aspirasi->category->nama }}</p>
        <p><b>Lokasi:</b> {{ $aspirasi->lokasi }}</p>
        <p><b>Status:</b>
            <span class="badge bg-info">{{ $aspirasi->status }}</span>
        </p>

        @if($aspirasi->feedback)
        <hr>
        <h6>Feedback Admin</h6>
        <p>{{ $aspirasi->feedback->feedback }}</p>
        @endif

        <hr>
        <h6>Progres Perbaikan</h6>
        <ul class="list-group">
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