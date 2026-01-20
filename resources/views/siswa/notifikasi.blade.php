<h2>Notifikasi</h2>

<ul>
    @forelse($notifikasi as $n)
    <li style="{{ $n->read_at ? '' : 'font-weight:bold' }}">
        <b>{{ $n->data['judul'] }}</b><br>
        {{ $n->data['pesan'] }}<br>

        <small>{{ $n->created_at }}</small>

        @if(!$n->read_at)
        <form action="/siswa/notifikasi/{{ $n->id }}/read" method="POST">
            @csrf
            <button type="submit">Tandai Dibaca</button>
        </form>
        @endif
        <hr>
    </li>
    @empty
    <li>Tidak ada notifikasi</li>
    @endforelse
</ul>