@extends('layouts.app')
@section('title','Data Aspirasi')

@section('content')
<div class="fade-slide">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-clipboard-data-fill text-primary"></i>
        Data Aspirasi
    </h4>

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aspirasi as $i => $a)
                    <tr>
                        <td>{{ $aspirasi->firstItem() + $i }}</td>
                        <td>{{ $a->user->name }}</td>
                        <td>{{ $a->category->nama }}</td>
                        <td>
                            <span class="badge bg-{{ 
                                $a->status=='menunggu' ? 'warning' :
                                ($a->status=='diproses' ? 'info' : 'success')
                            }}">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>
                        <td>{{ $a->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/admin/aspirasi/{{ $a->id }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    @if($aspirasi->count() == 0)
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Belum ada aspirasi
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $aspirasi->links() }}
    </div>

</div>
@endsection