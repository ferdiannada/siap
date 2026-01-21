<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Pengaduan Sekolah')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS (WAJIB) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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

        .fade-slide {
            animation: fadeSlide .6s ease-in-out;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .aspirasi-card {
            border-radius: 12px;
            transition: .25s ease;
        }

        .aspirasi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, .08);
        }

        .badge-status {
            display: inline-block;
            padding: 10px 14px;
            font-size: 0.9rem;
            border-radius: 30px;
            color: #fff;
        }

        .fade-slide {
            animation: fadeSlide .6s ease-in-out;
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

        .hover-card {
            transition: .25s ease;
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, .08);
        }

        .zoom-img {
            cursor: pointer;
            transition: transform .3s ease;
        }

        .zoom-img:hover {
            transform: scale(1.03);
        }

        /* TIMELINE */
        .timeline {
            list-style: none;
            padding-left: 0;
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 18px;
            top: 0;
            width: 2px;
            height: 100%;
            background: #dee2e6;
        }

        .timeline-item {
            position: relative;
            padding-left: 50px;
            margin-bottom: 25px;
        }

        .timeline-icon {
            position: absolute;
            left: 8px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            color: #fff;
            text-align: center;
            font-size: 12px;
            line-height: 22px;
        }

        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-top: 20px;
        }

        .stepper-wrapper::before {
            content: '';
            position: absolute;
            top: 22px;
            left: 0;
            width: 100%;
            height: 4px;
            background: #dee2e6;
            z-index: 1;
        }

        .stepper-item {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
        }

        .stepper-item .step-counter {
            width: 44px;
            height: 44px;
            background: #dee2e6;
            border-radius: 50%;
            margin: 0 auto 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #6c757d;
            transition: .3s ease;
        }

        .stepper-item .step-name {
            font-weight: 600;
            font-size: 14px;
        }

        .stepper-item.completed .step-counter {
            background: #198754;
            color: #fff;
        }

        .stepper-item.active .step-counter {
            background: #0d6efd;
            color: #fff;
            transform: scale(1.1);
        }

        .stepper-item.completed .step-name {
            color: #198754;
        }

        .stepper-item.active .step-name {
            color: #0d6efd;
        }

        /* WRAPPER */
        .animated-stepper {
            position: relative;
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        /* GARIS DASAR */
        .animated-stepper::before {
            content: '';
            position: absolute;
            top: 22px;
            left: 0;
            width: 100%;
            height: 4px;
            background: #dee2e6;
            z-index: 1;
        }

        /* GARIS PROGRESS (ANIMATED) */
        .stepper-progress {
            position: absolute;
            top: 22px;
            left: 0;
            height: 4px;
            width: 0;
            background: #0d6efd;
            z-index: 2;
            transition: width 0.8s ease-in-out;
        }

        /* ITEM */
        .stepper-item {
            position: relative;
            z-index: 3;
            text-align: center;
            width: 100%;
        }

        /* CIRCLE */
        .step-counter {
            width: 44px;
            height: 44px;
            background: #dee2e6;
            border-radius: 50%;
            margin: 0 auto 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #6c757d;
            transition: all .4s ease;
        }

        /* LABEL */
        .step-name {
            font-weight: 600;
            font-size: 14px;
            transition: color .3s ease;
        }

        /* COMPLETED */
        .stepper-item.completed .step-counter {
            background: #198754;
            color: #fff;
            transform: scale(1.05);
        }

        /* ACTIVE */
        .stepper-item.active .step-counter {
            background: #0d6efd;
            color: #fff;
            animation: pulse 1.2s infinite;
        }

        .stepper-item.completed .step-name {
            color: #198754;
        }

        .stepper-item.active .step-name {
            color: #0d6efd;
        }

        /* PULSE ANIMATION */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, .6);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
            }
        }

        /* SIDEBAR LINK */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            margin-bottom: 6px;
            border-radius: 8px;
            color: #adb5bd;
            text-decoration: none;
            transition: all .25s ease;
            font-weight: 500;
        }

        .sidebar-link i {
            font-size: 18px;
        }

        /* HOVER */
        .sidebar-link:hover {
            background: rgba(255, 255, 255, .08);
            color: #fff;
            transform: translateX(4px);
        }

        /* ACTIVE */
        .sidebar-link.active {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: #fff;
            box-shadow: 0 4px 15px rgba(13, 110, 253, .35);
        }

        .sidebar-link.active i {
            color: #fff;
        }

        /* ============================= */
        /* SIDEBAR SISWA STYLE */
        /* ============================= */

        .sidebar-link.siswa {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            margin-bottom: 6px;
            border-radius: 8px;
            color: #ced4da;
            text-decoration: none;
            transition: all .25s ease;
            font-weight: 500;
        }

        .sidebar-link.siswa i {
            font-size: 18px;
        }

        /* HOVER SISWA */
        .sidebar-link.siswa:hover {
            background: rgba(13, 110, 253, .15);
            color: #fff;
            transform: translateX(4px);
        }

        /* ACTIVE SISWA */
        .sidebar-link.siswa.active {
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            color: #fff;
            box-shadow: 0 4px 15px rgba(13, 110, 253, .35);
        }

        .sidebar-link.siswa.active i {
            color: #fff;
        }
    </style>



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

            <span class="navbar-brand ms-2 fw-semibold">
                <i class="bi bi-shield-lock-fill"></i>
                Admin Pengaduan Sekolah
            </span>

            <div class="d-flex align-items-center text-white">
                @if(auth()->user()->role === 'siswa')
                <li class="nav-item dropdown list-unstyled me-3">
                    <a class="nav-link position-relative text-white" href="#" id="notifDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="bi bi-bell fs-5"></i>

                        <!-- BADGE (DINAMIS JS) -->
                        <span id="notifBadge"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
                            0
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow" style="width:320px" id="notifList">
                        <li class="dropdown-header">Notifikasi</li>
                        <li>
                            <span class="dropdown-item text-muted">
                                Memuat notifikasi...
                            </span>
                        </li>
                    </ul>
                </li>
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

            <h6 class="text-uppercase">Menu</h6>
            @if (auth()->user()->role === 'siswa')

            <div class="text-center text-white mb-3">
                <i class="bi bi-person-circle fs-2"></i>
                <div class="fw-semibold mt-1">
                    {{ auth()->user()->name }}
                </div>
                <small class="">Siswa</small>
            </div>
            @endif

            <!-- ADMIN MENU -->
            @if(auth()->user()->role === 'admin')

            <div class="mb-3">
                <small class="text-uppercase fw-semibold">
                    Admin Panel
                </small>
            </div>

            <a href="/admin/dashboard" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="/admin/aspirasi" class="sidebar-link {{ request()->is('admin/aspirasi*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data-fill"></i>
                <span>Data Aspirasi</span>
            </a>

            <a href="/admin/categories" class="sidebar-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i>
                <span>Kategori Aspirasi</span>
            </a>

            @endif

            <!-- SISWA MENU -->
            @if(auth()->user()->role === 'siswa')

            <div class="mb-3 mt-2">
                <small class="text-uppercase fw-semibold">
                    Menu Siswa
                </small>
            </div>

            <a href="/siswa/dashboard"
                class="sidebar-link siswa {{ request()->is('siswa/dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="/siswa/aspirasi" class="sidebar-link siswa {{ request()->is('siswa/aspirasi*') ? 'active' : '' }}">
                <i class="bi bi-pencil-square"></i>
                <span>Aspirasi Saya</span>
            </a>

            <a href="/siswa/notifikasi"
                class="sidebar-link siswa {{ request()->is('siswa/notifikasi*') ? 'active' : '' }}">
                <i class="bi bi-bell-fill"></i>
                <span>Notifikasi</span>
            </a>

            @endif

        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-grow-1 p-4" style="margin-top:56px;">
            @yield('content')
        </div>
    </div>

    <script>
        document.getElementById('btnSidebar').onclick = function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
}
    </script>
    <!-- jQuery (WAJIB sebelum Select2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SCRIPT DARI VIEW --}}
    @stack('scripts')

    @if (auth()->user()->role === 'siswa')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

    const badge = document.getElementById('notifBadge');
    const list  = document.getElementById('notifList');

    if (!badge || !list) return;

    function loadNotifications() {
        fetch('/notifikasi/unread')
            .then(res => res.json())
            .then(res => {

                list.innerHTML =
                    '<li class="dropdown-header">Notifikasi</li>';

                if (res.count > 0) {
                    badge.textContent = res.count;
                    badge.classList.remove('d-none');

                    res.data.forEach(notif => {
                        list.innerHTML += `
                            <li>
                                <a href="/siswa/aspirasi/${notif.data.aspirasi_id}?notif=${notif.id}"
                                   class="dropdown-item notif-item"
                                   data-id="${notif.id}">
                                    <strong>${notif.data.judul}</strong>
                                    <div class="small text-muted">
                                        ${notif.data.pesan}
                                    </div>
                                </a>
                            </li>
                        `;
                    });
                } else {
                    badge.classList.add('d-none');
                    list.innerHTML += `
                        <li>
                            <span class="dropdown-item text-muted">
                                Tidak ada notifikasi baru
                            </span>
                        </li>
                    `;
                }
            })
            .catch(err => console.error(err));
    }

    // MARK AS READ
    document.addEventListener('click', function (e) {
        const item = e.target.closest('.notif-item');
        if (!item) return;

        fetch('/notifikasi/read/' + item.dataset.id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
    });

    loadNotifications();
    setInterval(loadNotifications, 5000); // realtime feel
});
    </script>

    @endif



</body>

</html>