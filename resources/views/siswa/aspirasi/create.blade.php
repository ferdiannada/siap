<h2>Buat Aspirasi</h2>

<form action="/siswa/aspirasi" method="POST">
    @csrf

    <label>Kategori</label>
    <select name="category_id">
        @foreach($categories as $c)
        <option value="{{ $c->id }}">{{ $c->nama }}</option>
        @endforeach
    </select>
    <br>

    <label>Lokasi</label>
    <input type="text" name="lokasi" required>
    <br>

    <label>Deskripsi</label>
    <textarea name="deskripsi" required></textarea>
    <br>

    <button type="submit">Kirim Aspirasi</button>
</form>