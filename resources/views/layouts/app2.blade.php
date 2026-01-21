<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Pengaduan Sekolah')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS (WAJIB) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">



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

            <a href="/admin/siswa/import"
                class="sidebar-link {{ request()->is('admin/siswa/import') ? 'active' : '' }}">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Import Data Siswa</span>
            </a>

            <a href="/admin/siswa/reset-password"
                class="sidebar-link {{ request()->is('admin/siswa/reset-password') ? 'active' : '' }}">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Reset Password Siswa</span>
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