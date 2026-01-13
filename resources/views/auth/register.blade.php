<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
</head>

<body>
    <form method="POST" action="/register">
        @csrf

        <input type="text" name="name" placeholder="Nama Lengkap">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="nis" placeholder="NIS">
        <input type="text" name="kelas" placeholder="Kelas">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password_confirmation" placeholder="Ulangi Password">

        <button type="submit">Daftar</button>
    </form>

</body>

</html>