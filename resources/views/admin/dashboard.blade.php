<h2>Dashboard Admin - List Aspirasi</h2>

<form method="GET" action="/admin/dashboard">
    <input type="date" name="tanggal" value="{{ request('tanggal') }}">

    <input type="month" name="bulan" value="{{ request('bulan') }}">

    <select name="siswa_id">
        <option value="">-- Semua Siswa --</option>
        @foreach($siswas as $s)
        <option value="{{ $s->id }}" {{ request('siswa_id')==$s->id?'selected':'' }}>
            {{ $s->name }} ({{ $s->nis }})
        </option>
        @endforeach
    </select>

    <select name="category_id">
        <option value="">-- Semua Kategori --</option>
        @foreach($categories as $c)
        <option value="{{ $c->id }}" {{ request('category_id')==$c->id?'selected':'' }}>
            {{ $c->nama }}
        </option>
        @endforeach
    </select>

    <select name="status">
        <option value="">-- Semua Status --</option>
        <option value="menunggu" {{ request('status')=='menunggu' ?'selected':'' }}>Menunggu</option>
        <option value="diproses" {{ request('status')=='diproses' ?'selected':'' }}>Diproses</option>
        <option value="selesai" {{ request('status')=='selesai' ?'selected':'' }}>Selesai</option>
    </select>

    <button type="submit">Filter</button>
    <a href="/admin/dashboard">Reset</a>
</form>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Siswa</th>
        <th>NIS</th>
        <th>Kategori</th>
        <th>Lokasi</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    @foreach($aspirasi as $a)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $a->user->name }}</td>
        <td>{{ $a->user->nis }}</td>
        <td>{{ $a->category->nama }}</td>
        <td>{{ $a->lokasi }}</td>
        <td>{{ $a->status }}</td>
        <td>{{ $a->created_at->format('d-m-Y') }}</td>
        <td>
            <a href="/admin/aspirasi/{{ $a->id }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>

{{ $aspirasi->withQueryString()->links() }}