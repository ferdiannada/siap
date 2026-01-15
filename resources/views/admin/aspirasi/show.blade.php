<h2>Detail Aspirasi</h2>

<p><b>Siswa:</b> {{ $aspirasi->user->name }} ({{ $aspirasi->user->nis }})</p>
<p><b>Kategori:</b> {{ $aspirasi->category->nama }}</p>
<p><b>Lokasi:</b> {{ $aspirasi->lokasi }}</p>
<p><b>Deskripsi:</b> {{ $aspirasi->deskripsi }}</p>
<p><b>Status Saat Ini:</b> {{ $aspirasi->status }}</p>

<hr>

<h3>Ubah Status</h3>

<form action="/admin/aspirasi/{{ $aspirasi->id }}/status" method="POST">
    @csrf

    <select name="status">
        <option value="menunggu" {{ $aspirasi->status=='menunggu'?'selected':'' }}>Menunggu</option>
        <option value="diproses" {{ $aspirasi->status=='diproses'?'selected':'' }}>Diproses</option>
        <option value="selesai" {{ $aspirasi->status=='selesai'?'selected':'' }}>Selesai</option>
    </select>

    <button type="submit">Update Status</button>
</form>

<hr>

<h3>Tambah Progres Perbaikan</h3>

<form action="/admin/aspirasi/{{ $aspirasi->id }}/progress" method="POST">
    @csrf

    <textarea name="keterangan" rows="3" placeholder="Contoh: Teknisi sudah mengecek kerusakan..." required></textarea>
    <br>
    <button type="submit">Tambah Progres</button>
</form>

<hr>

<h3>Riwayat Progres Perbaikan</h3>

<ul>
    @foreach($aspirasi->progress as $p)
    <li>
        {{ $p->keterangan }}
        <small>({{ $p->created_at }})</small>
    </li>
    @endforeach
</ul>


<h3>Histori Perubahan Status</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Status Lama</th>
        <th>Status Baru</th>
        <th>Diubah Oleh</th>
        <th>Tanggal</th>
    </tr>

    @foreach($aspirasi->histories as $h)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $h->status_lama }}</td>
        <td>{{ $h->status_baru }}</td>
        <td>{{ $h->admin->name }}</td>
        <td>{{ $h->created_at }}</td>
    </tr>
    @endforeach
</table>

<a href="/admin/dashboard">Kembali</a>