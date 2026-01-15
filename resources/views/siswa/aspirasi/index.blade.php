<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aspirasi Index</title>
</head>

<body>
    <h2>Daftar Aspirasi Saya</h2>

    <a href="/siswa/aspirasi/create">Buat Aspirasi Baru</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($aspirasi as $a)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $a->category->nama }}</td>
            <td>{{ $a->lokasi }}</td>
            <td>{{ $a->status }}</td>
            <td>
                <a href="/siswa/aspirasi/{{ $a->id }}">Detail</a> |
                <a href="/siswa/aspirasi/{{ $a->id }}/edit">Edit</a>

                <form action="/siswa/aspirasi/{{ $a->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>