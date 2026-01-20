<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Pengaduan Sekolah')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Animasi dasar */
        .fade-slide {
            animation: fadeSlide 0.6s ease-in-out;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hover row tabel */
        .table-hover tbody tr:hover {
            background-color: #f5f7fa;
            transition: 0.2s;
        }

        .fade-slide {
            animation: fadeSlide 0.6s ease-in-out;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card,
        .action-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover,
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <button class="btn btn-primary" id="btnSidebar">
                <i class="bi bi-list"></i>
            </button>

            <span class="navbar-brand ms-2">Sistem Pengaduan Sekolah</span>

            <div class="d-flex align-items-center text-white">
                @if(auth()->user()->role === 'siswa')
                <a href="/siswa/notifikasi" class="text-white me-3 position-relative">
                    <i class="bi bi-bell fs-5"></i>
                    @if(auth()->user()->unreadNotifications->count())
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                    @endif
                </a>
                @endif

                <span class="me-3">{{ auth()->user()->name }}</span>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div class="d-flex">
        <div id="sidebar" class="bg-dark text-white p-3 vh-100" style="width:240px; margin-top:56px; transition:0.3s;">

            <h6 class="text-uppercase text-muted">Menu</h6>

            <!-- ADMIN MENU -->
            @if(auth()->user()->role === 'admin')
            <a href="/admin/dashboard" class="d-block text-white mb-2 text-decoration-none">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            @endif

            <!-- SISWA MENU -->
            @if(auth()->user()->role === 'siswa')
            <a href="/siswa/dashboard" class="d-block text-white mb-2 text-decoration-none">
                <i class="bi bi-house"></i> Dashboard
            </a>
            <a href="/siswa/aspirasi" class="d-block text-white mb-2 text-decoration-none">
                <i class="bi bi-pencil-square"></i> Aspirasi Saya
            </a>
            <a href="/siswa/notifikasi" class="d-block text-white mb-2 text-decoration-none">
                <i class="bi bi-bell"></i> Notifikasi
            </a>
            @endif
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-grow-1 p-4" style="margin-top:56px;">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('btnSidebar').onclick = function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
}
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</body>

</html>