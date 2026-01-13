<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>

<body>
    Selamat anda berhasil login <u>{{ Auth::user()->name }}</u> sebagai {{ Auth::user()->role }}.
</body>

</html>