@extends('layouts.app')
@section('title','Data Aspirasi')

@section('content')
<div class="fade-slide">

    <!-- HEADER -->
    <div class="dashboard-welcome p-4 mb-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-clipboard-data"></i>
                    Data Aspirasi
                </h4>
                <p class="mb-0 opacity-75">
                    Daftar seluruh laporan sarana dari siswa
                </p>
            </div>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card aspirasi-table-card shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Siswa</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($aspirasi as $a)
                        <tr class="{{ is_null($a->dibaca_admin_at ?? null) ? 'table-new' : '' }}">

                            <td class="fw-semibold">
                                {{ $loop->iteration + ($aspirasi->currentPage()-1)*$aspirasi->perPage() }}
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $a->user->name }}
                                </div>
                                <small class="text-muted">
                                    {{ $a->user->email }}
                                </small>
                            </td>

                            <td>
                                <span class="badge rounded-pill bg-secondary">
                                    <i class="bi bi-tags-fill"></i>
                                    {{ $a->category->nama }}
                                </span>
                            </td>

                            <td>
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                {{ $a->lokasi }}
                            </td>

                            <td>
                                <span class="badge-status
                                    {{ $a->status=='menunggu' ? 'bg-warning' :
                                       ($a->status=='diproses' ? 'bg-info' : 'bg-success') }}">
                                    <i class="bi
                                        {{ $a->status=='menunggu' ? 'bi-hourglass-split' :
                                           ($a->status=='diproses' ? 'bi-gear-fill' : 'bi-check-circle-fill') }}">
                                    </i>
                                    {{ ucfirst($a->status) }}
                                </span>
                            </td>

                            <td>
                                <small class="text-muted">
                                    {{ $a->created_at->format('d M Y') }}<br>
                                    {{ $a->created_at->format('H:i') }}
                                </small>
                            </td>

                            <td class="text-end">
                                <a href="/admin/aspirasi/{{ $a->id }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                    Detail
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 mb-2"></i>
                                <div>Belum ada data aspirasi</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $aspirasi->links() }}
    </div>

</div>
@endsection