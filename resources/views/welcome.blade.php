<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Pengaduan Sarana Sekolah</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system;
            background: #f4f6fb;
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            color: #fff;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before,
        .hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .hero::before {
            width: 600px;
            height: 600px;
            top: -200px;
            left: -200px;
        }

        .hero::after {
            width: 500px;
            height: 500px;
            bottom: -180px;
            right: -180px;
        }

        .hero h1 {
            font-weight: 800;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        /* FEATURE */
        .feature-card {
            border-radius: 18px;
            transition: .35s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
            margin-bottom: 16px;
        }

        /* STATS */
        .stat-box {
            text-align: center;
            padding: 20px;
        }

        .stat-box h3 {
            font-weight: 800;
            color: #0d6efd;
        }

        /* STEP */
        .step {
            text-align: center;
            padding: 20px;
        }

        .step i {
            font-size: 42px;
            color: #0d6efd;
        }

        /* CTA */
        .cta {
            background: linear-gradient(135deg, #0b1220, #111827);
            color: #fff;
        }

        /* FOOTER */
        footer {
            background: #0b1220;
            color: #adb5bd;
        }
    </style>
</head>

<body>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <h1 class="display-5 mb-3">
                        Sistem Pengaduan Sarana Sekolah
                    </h1>
                    <p class="lead mb-4">
                        Platform digital resmi sekolah untuk menampung aspirasi siswa
                        terkait fasilitas secara cepat, transparan, dan profesional.
                    </p>

                    <a href="/login" class="btn btn-light btn-lg px-5 shadow">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk ke Sistem
                    </a>

                    <p class="small mt-3 opacity-75">
                        Akun siswa dikelola langsung oleh pihak sekolah
                    </p>
                </div>

                <div class="col-md-6 d-none d-md-block" data-aos="zoom-in">
                    <div class="glass-card text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2920/2920277.png" class="img-fluid"
                            style="max-height:340px;">
                        <p class="mt-3 mb-0 fw-semibold">
                            Solusi Pengaduan Sekolah Modern
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 stat-box" data-aos="fade-up" data-aos-delay="100">
                    <h3>100%</h3>
                    <p class="text-muted mb-0">Aspirasi Terdokumentasi</p>
                </div>
                <div class="col-md-4 stat-box" data-aos="fade-up" data-aos-delay="200">
                    <h3>Real‑Time</h3>
                    <p class="text-muted mb-0">Status & Notifikasi</p>
                </div>
                <div class="col-md-4 stat-box" data-aos="fade-up" data-aos-delay="300">
                    <h3>Terpusat</h3>
                    <p class="text-muted mb-0">Dikelola Pihak Sekolah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURE -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h3 class="fw-bold">Keunggulan Sistem</h3>
                <p class="text-muted">
                    Dibangun untuk sekolah yang transparan dan modern
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card feature-card shadow-sm h-100">
                        <div class="card-body">
                            <div class="feature-icon bg-primary">
                                <i class="bi bi-lightning-fill"></i>
                            </div>
                            <h5 class="fw-bold">Cepat & Efisien</h5>
                            <p class="text-muted">
                                Pengaduan dikirim tanpa proses berbelit.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card feature-card shadow-sm h-100">
                        <div class="card-body">
                            <div class="feature-icon bg-success">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                            <h5 class="fw-bold">Transparan</h5>
                            <p class="text-muted">
                                Status aspirasi dapat dipantau real‑time.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card feature-card shadow-sm h-100">
                        <div class="card-body">
                            <div class="feature-icon bg-warning">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h5 class="fw-bold">Resmi & Aman</h5>
                            <p class="text-muted">
                                Sistem internal sekolah yang terkontrol.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FLOW -->
    <section class="bg-white py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h3 class="fw-bold">Alur Pengaduan</h3>
                <p class="text-muted">Sederhana dan terstruktur</p>
            </div>

            <div class="row">
                <div class="col-md-4 step" data-aos="flip-left">
                    <i class="bi bi-pencil-square"></i>
                    <h6 class="fw-bold mt-3">Buat Aspirasi</h6>
                    <p class="text-muted">
                        Siswa melaporkan kerusakan fasilitas.
                    </p>
                </div>

                <div class="col-md-4 step" data-aos="flip-left" data-aos-delay="150">
                    <i class="bi bi-gear-fill"></i>
                    <h6 class="fw-bold mt-3">Diproses Sekolah</h6>
                    <p class="text-muted">
                        Admin menindaklanjuti laporan.
                    </p>
                </div>

                <div class="col-md-4 step" data-aos="flip-left" data-aos-delay="300">
                    <i class="bi bi-check-circle-fill"></i>
                    <h6 class="fw-bold mt-3">Selesai</h6>
                    <p class="text-muted">
                        Perbaikan dilakukan & siswa diberi notifikasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta py-5" data-aos="zoom-in">
        <div class="container text-center">
            <h3 class="fw-bold mb-3">
                Sekolah Modern Mendengar Aspirasi Siswanya
            </h3>
            <p class="mb-4">
                Sistem pengaduan sarana yang profesional dan transparan
            </p>
            <a href="/login" class="btn btn-primary btn-lg px-5">
                Masuk ke Sistem
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-4">
        <div class="container text-center">
            <small>
                © {{ date('Y') }} Sistem Pengaduan Sarana Sekolah
            </small>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
        duration: 900,
        easing: 'ease-in-out',
        once: true
    });
    </script>

</body>

</html>