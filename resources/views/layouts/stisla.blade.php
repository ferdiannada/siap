<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Admin')</title>

    <link rel="stylesheet" href="/stisla/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/stisla/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/stisla/css/style.css">
    <link rel="stylesheet" href="/stisla/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            {{-- Navbar --}}
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav mr-auto">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="/stisla/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            {{-- Sidebar --}}
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">Pengaduan</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li>
                            <a href="/admin/dashboard" class="nav-link">
                                <i class="fas fa-fire"></i><span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            {{-- Content --}}
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>

        </div>
    </div>

    <script src="/stisla/modules/jquery.min.js"></script>
    <script src="/stisla/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/stisla/js/stisla.js"></script>
    <script src="/stisla/js/scripts.js"></script>
</body>

</html>