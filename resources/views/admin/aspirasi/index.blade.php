@extends('layouts.app')
@section('title','Data Aspirasi')

@section('content')
<div class="fade-slide">

    <div class="mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-clipboard-data-fill text-primary"></i>
            Data Aspirasi
        </h4>
        <p class="text-muted mb-0">
            Semua laporan aspirasi siswa
        </p>
    </div>

    <div class="card shadow-sm aspirasi-table-card">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($aspirasi as $i => $a)
                    <tr class="{{ $a->is_new ? 'table-new' : '' }}">
                        <td>{{ $aspirasi->firstItem() + $i }}</td>

                        <td>
                            <div class="fw-semibold">
                                {{ $a->user->name }}
                                @if($a->is_new)
                                <span class="badge bg-danger ms-1">New</span>
                                @endif
                            </div>
                            <small class="text-muted">{{ $a->user->kelas }}</small>
                        </td>

                        <td>
                            <span class="badge rounded-pill bg-secondary">
                                {{ $a->category->nama }}
                            </span>
                        </td>

                        <td>{{ $a->lokasi }}</td>

                        <td>
                            <span class="badge-status
                            {{ $a->status=='menunggu' ? 'bg-warning' :
                               ($a->status=='diproses' ? 'bg-info' : 'bg-success') }}">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>

                        <td>{{ $a->created_at->format('d M Y') }}</td>

                        <td class="text-center">
                            <a href="/admin/aspirasi/{{ $a->id }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada aspirasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $aspirasi->links() }}
    </div>

</div>
@endsection