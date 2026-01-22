<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Pengaduan Sekolah</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border-radius: 18px;
            overflow: hidden;
            animation: fadeSlide .7s ease;
        }

        .login-left {
            background: linear-gradient(160deg, #0d6efd, #0a58ca);
            color: #fff;
            padding: 40px;
        }

        .login-left i {
            font-size: 80px;
            opacity: .9;
        }

        .login-right {
            padding: 40px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .input-group-text {
            background: #f1f3f5;
            border-right: 0;
        }

        .form-control {
            border-left: 0;
        }

        .btn-login {
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            border: none;
        }

        .btn-login:hover {
            opacity: .9;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* FLOATING ICON INPUT */
        .floating-icon {
            position: relative;
        }

        .floating-icon label {
            padding-left: 38px;
        }

        .floating-icon .form-control {
            padding-left: 38px;
        }

        .floating-icon::before {
            content: '';
        }

        /* ICON POSITION */
        .floating-icon label i {
            color: #0d6efd;
        }

        /* TOGGLE PASSWORD */
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        .toggle-password:hover {
            color: #0d6efd;
        }

        /* SMOOTH */
        .form-floating>.form-control:focus~label {
            color: #0d6efd;
        }

        /* SVG LOGIN ILLUSTRATION */
        .login-illustration {
            margin: auto;
        }

        /* FLOAT ICON */
        .float-icon {
            animation: float 3s ease-in-out infinite;
            transform-origin: center;
        }

        /* PULSE EFFECT */
        .pulse-circle {
            animation: pulse 2.5s infinite;
            transform-origin: center;
        }

        /* ANIMATIONS */
        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: .8;
            }

            70% {
                transform: scale(1.2);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        /* LOGIN OVERLAY */
        .login-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn .4s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* PAGE FADE OUT */
        .fade-out {
            animation: fadeOut .6s ease forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg login-card">
                    <div class="row g-0">

                        <!-- LEFT -->
                        <div class="col-md-6 d-none d-md-flex login-left align-items-center">
                            <div class="w-100 text-center">

                                <!-- SVG ILLUSTRATION -->
                                <svg width="220" height="220" viewBox="0 0 200 200" class="login-illustration">
                                    <circle cx="100" cy="100" r="70" fill="rgba(255,255,255,0.15)" />

                                    <circle cx="100" cy="100" r="55" fill="rgba(255,255,255,0.25)"
                                        class="pulse-circle" />

                                    <!-- ICON CENTER -->
                                    <g class="float-icon">
                                        <circle cx="100" cy="100" r="40" fill="#ffffff" />
                                        <path d="M100 65
                         a20 20 0 1 1 0 40
                         a20 20 0 1 1 0 -40" fill="#0d6efd" />
                                    </g>
                                </svg>

                                <h3 class="fw-bold mt-4">
                                    Sistem Pengaduan Sekolah
                                </h3>

                                <p class="mt-2 opacity-75">
                                    Sampaikan aspirasi dan pantau perbaikan
                                    sarana sekolah secara digital.
                                </p>

                            </div>
                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-6 login-right">
                            <h4 class="fw-bold mb-2">
                                <i class="bi bi-box-arrow-in-right text-primary"></i>
                                Login
                            </h4>
                            <p class="text-muted mb-4">
                                Silakan login untuk melanjutkan
                            </p>

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="/login" method="POST" id="loginForm">
                                @csrf

                                <!-- EMAIL -->
                                <div class="form-floating mb-3 floating-icon">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    <label for="email">
                                        <i class="bi bi-envelope-fill me-1"></i> Email
                                    </label>

                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <!-- PASSWORD -->
                                <div class="form-floating mb-3 floating-icon">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password">
                                    <label for="password">
                                        <i class="bi bi-lock-fill me-1"></i> Password
                                    </label>

                                    <span class="toggle-password" onclick="togglePassword()">
                                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                                    </span>

                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <!-- BUTTON -->
                                <div class="d-grid mt-4">
                                    <button class="btn btn-login text-white">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                        Login
                                    </button>
                                </div>
                            </form>

                            <div class="text-center mt-4 text-muted">
                                © {{ date('Y') }} Sistem Pengaduan Sekolah
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                pass.type = 'password';
                icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        }
    </script>
    <script>
        const form = document.getElementById('loginForm');

        form.addEventListener('submit', function () {

            // Tampilkan overlay loading
            document.getElementById('loginOverlay')
                .classList.remove('d-none');

            // Fade out halaman
            document.body.classList.add('fade-out');
        });
    </script>


    <!-- LOGIN SUCCESS OVERLAY -->
    <div id="loginOverlay" class="login-overlay d-none">
        <div class="text-center text-white">
            <div class="spinner-border mb-3"></div>
            <h5>Login berhasil</h5>
            <p class="opacity-75">Mengalihkan ke dashboard...</p>
        </div>
    </div>


</body>

</html>