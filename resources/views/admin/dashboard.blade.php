@extends('layouts.app')
@section('title','Dashboard Admin')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Dashboard Admin</h4>
        <span class="text-muted">Manajemen Aspirasi Sekolah</span>
    </div>

    <!-- STATISTIK -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm fade-slide">
                <div class="card-body">
                    <h6 class="text-muted">Total Aspirasi</h6>
                    <h3 class="fw-bold">{{ $aspirasi->total() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm fade-slide">
                <div class="card-body">
                    <h6 class="text-muted">Diproses</h6>
                    <h3 class="fw-bold text-info">
                        {{ \App\Models\Aspirasi::where('status','diproses')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm fade-slide">
                <div class="card-body">
                    <h6 class="text-muted">Selesai</h6>
                    <h3 class="fw-bold text-success">
                        {{ \App\Models\Aspirasi::where('status','selesai')->count() }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="card shadow-sm fade-slide">
        <div class="card-header bg-white fw-bold">
            Daftar Aspirasi
        </div>

        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasi as $a)
                    <tr>
                        <td>{{ $loop->iteration + ($aspirasi->currentPage()-1)*$aspirasi->perPage() }}</td>
                        <td>{{ $a->user->name }}</td>
                        <td>{{ $a->category->nama }}</td>
                        <td>
                            <span class="badge status-badge" data-status="{{ $a->status }}">
                                {{ strtoupper($a->status) }}
                            </span>
                        </td>
                        <td>{{ $a->created_at->format('d-m-Y') }}</td>
                        <td class="text-center">
                            <a href="/admin/aspirasi/{{ $a->id }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Tidak ada data aspirasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="card-footer bg-white">
            {{ $aspirasi->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Badge status dinamis
document.querySelectorAll('.status-badge').forEach(el => {
    const s = el.dataset.status;
    el.classList.add(
        s === 'menunggu' ? 'bg-warning' :
        s === 'diproses' ? 'bg-info' :
        'bg-success'
    );
});
</script>
@endpush