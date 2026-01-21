<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Sistem Pengaduan Sekolah')</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', system-ui, -apple-system;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 16px;
            color: #fff;
            transition: .3s ease;
            z-index: 1000;
        }

        /* ADMIN */
        .sidebar.admin {
            background: linear-gradient(180deg, #0d6efd, #5f3dc4);
        }

        /* SISWA */
        .sidebar.siswa {
            background: linear-gradient(180deg, #0d6efd, #15aabf);
        }

        .sidebar-brand {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand i {
            font-size: 26px;
        }

        .sidebar-section {
            font-size: 0.75rem;
            text-transform: uppercase;
            opacity: .75;
            margin: 20px 0 8px;
            letter-spacing: .8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            margin-bottom: 6px;
            border-radius: 12px;
            color: rgba(255, 255, 255, .85);
            text-decoration: none;
            font-weight: 500;
            transition: all .25s ease;
        }

        .sidebar-link i {
            font-size: 20px;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, .15);
            color: #fff;
            transform: translateX(6px);
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, .25);
            color: #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .25);
        }

        /* ================= MAIN ================= */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* ================= NAVBAR ================= */
        .topbar {
            height: 64px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar {{ auth()->user()->role }}">
        <div class="sidebar-brand">
            <i class="bi bi-buildings"></i>
            <span>Pengaduan Sekolah</span>
        </div>

        @if(auth()->user()->role === 'admin')
        <div class="sidebar-section">Admin</div>

        <a href="/admin/dashboard" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="/admin/aspirasi" class="sidebar-link {{ request()->is('admin/aspirasi*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-data"></i>
            Data Aspirasi
        </a>

        <a href="/admin/categories" class="sidebar-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i>
            Kategori
        </a>

        <a href="/admin/siswa/import" class="sidebar-link {{ request()->is('admin/siswa*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            Data Siswa
        </a>
        @endif

        @if(auth()->user()->role === 'siswa')
        <div class="sidebar-section">Siswa</div>

        <a href="/siswa/dashboard" class="sidebar-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i>
            Dashboard
        </a>

        <a href="/siswa/aspirasi" class="sidebar-link {{ request()->is('siswa/aspirasi*') ? 'active' : '' }}">
            <i class="bi bi-pencil-square"></i>
            Aspirasi Saya
        </a>

        <a href="/siswa/notifikasi" class="sidebar-link {{ request()->is('siswa/notifikasi*') ? 'active' : '' }}">
            <i class="bi bi-bell-fill"></i>
            Notifikasi
        </a>
        @endif
    </div>

    {{-- MAIN --}}
    <div class="main-content">
        {{-- TOPBAR --}}
        <div class="topbar">
            <div>
                <strong>@yield('title')</strong>
            </div>

            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>
                <span>{{ auth()->user()->name }}</span>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger ms-2">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="p-4">
            @yield('content')
        </div>
    </div>

</body>

</html>