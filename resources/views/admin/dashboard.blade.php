@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<h4>Dashboard Admin</h4>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2">

            <div class="col-md-2">
                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>

            <div class="col-md-2">
                <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
            </div>

            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aspirasi as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->user->name }}</td>
                    <td>{{ $a->category->nama }}</td>
                    <td>
                        <span class="badge 
                            {{ $a->status=='menunggu'?'bg-warning':
                               ($a->status=='diproses'?'bg-info':'bg-success') }}">
                            {{ strtoupper($a->status) }}
                        </span>
                    </td>
                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="/admin/aspirasi/{{ $a->id }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $aspirasi->links() }}
    </div>
</div>
@endsection