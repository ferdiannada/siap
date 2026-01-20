<h2>Detail Aspirasi</h2>

<p><b>Kategori:</b> {{ $aspirasi->category->nama }}</p>
<p><b>Lokasi:</b> {{ $aspirasi->lokasi }}</p>
<p><b>Deskripsi:</b> {{ $aspirasi->deskripsi }}</p>
<p><b>Status:</b> {{ $aspirasi->status }}</p>

@if($aspirasi->feedback)
<p><b>Feedback Admin:</b> {{ $aspirasi->feedback->feedback }}</p>
@endif

<h3>Progres Perbaikan</h3>
<ul>
    @foreach($aspirasi->progress as $p)
    <li>{{ $p->keterangan }} ({{ $p->created_at }})</li>
    @endforeach
</ul>

@if($aspirasi->feedback)
<hr>
<h3>Feedback dari Admin</h3>
<p>{{ $aspirasi->feedback->feedback }}</p>
@endif

<a href="/siswa/aspirasi">Kembali</a>