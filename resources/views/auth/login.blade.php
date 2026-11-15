
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | SIPAMBA DPRD Provinsi Riau</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            overflow-x: hidden;
        }

        body {
            min-height: 100vh;
            min-height: 100svh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background:
                linear-gradient(
                    115deg,
                    rgba(12, 18, 43, .91),
                    rgba(12, 18, 43, .68),
                    rgba(12, 18, 43, .82)
                ),
                url("{{ asset('images/DSC_foto-kantor-DPRD-Riau-png.png') }}")
                center center / cover no-repeat fixed;
            color: #fff;
        }

        /* LAYOUT UTAMA */
        .login-wrapper {
            min-height: 100vh;
            min-height: 100svh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
            padding: 55px 8%;
        }

        /* BRANDING */
        .brand-section {
            max-width: 650px;
            animation: fadeInLeft .8s ease both;
        }

        .brand-logos {
            display: flex;
            align-items: center;
            gap: 22px;
            margin-bottom: 35px;
        }

        .brand-logo-dprd {
            width: 115px;
            height: 115px;
            padding: 7px;
            background: #fff;
            border-radius: 16px;
            object-fit: contain;
            box-shadow: 0 8px 25px rgba(0,0,0,.2);
        }

        .brand-logo-sipamba {
            width: 260px;
            max-width: 65%;
            height: 115px;
            object-fit: contain;
        }

        .brand-line {
            width: 75px;
            height: 4px;
            background: #D9B66D;
            border-radius: 10px;
            margin-bottom: 25px;
            animation: fadeInLeft 1.1s ease both;
        }

        .brand-section h1 {
            font-size: clamp(32px, 4vw, 52px);
            line-height: 1.15;
            font-weight: 750;
            margin: 0 0 20px;
            letter-spacing: -1px;
        }

        .brand-section h1 span {
            color: #E7C77E;
        }

        .brand-section p {
            max-width: 550px;
            color: rgba(255,255,255,.82);
            font-size: 16px;
            line-height: 1.8;
        }

        .institution {
            margin-top: 40px;
            padding-left: 15px;
            border-left: 3px solid #D9B66D;
            color: rgba(255,255,255,.85);
            font-size: 13px;
            letter-spacing: 1.5px;
            line-height: 1.8;
        }

        /* PANEL LOGIN */
        .login-card {
            width: 100%;
            max-width: 440px;
            flex-shrink: 0;
            padding: 42px;
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 22px;
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 25px 70px rgba(0,0,0,.3);
            color: #18213C;
            animation: fadeInRight .8s ease both;
        }

        .login-heading {
            margin-bottom: 30px;
        }

        .login-heading .eyebrow {
            color: #A17A35;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .login-heading h2 {
            font-size: 29px;
            font-weight: 750;
            margin: 0 0 8px;
            color: #17203D;
        }

        .login-heading p {
            margin: 0;
            color: #758096;
            font-size: 14px;
        }

        /* FORM INPUT */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: 700;
            color: #34405A;
        }

        .form-control {
            width: 100%;
            height: 49px;
            padding: 0 15px;
            border: 1px solid #DCE1EA;
            border-radius: 10px;
            background: #F8F9FC;
            color: #17203D;
            font-size: 14px;
            outline: none;
            transition: .2s ease;
        }

        .form-control:focus {
            border-color: #5154D8;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(81,84,216,.12);
        }

        .error-message {
            display: block;
            margin-top: 6px;
            color: #DC2626;
            font-size: 12px;
        }

        /* PASSWORD TOGGLE */
        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper .form-control {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 7px;
            background: transparent;
            color: #8490A5;
            cursor: pointer;
            transition: all .2s ease;
        }

        .password-toggle:hover {
            color: #5154D8;
            background: rgba(81,84,216,.08);
        }

        .password-toggle:focus-visible {
            outline: 2px solid #5154D8;
            outline-offset: 2px;
        }

        .password-toggle svg {
            display: block;
        }

        /* REMEMBER ME */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 3px 0 25px;
            color: #647087;
            font-size: 13px;
        }

        .remember-row input {
            width: 16px;
            height: 16px;
            accent-color: #5154D8;
        }

        .remember-row label {
            margin: 0;
            cursor: pointer;
        }

        /* TOMBOL LOGIN */
        .login-button {
            width: 100%;
            height: 51px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(110deg, #292E69, #5553D9);
            color: white;
            font-size: 14px;
            font-weight: 750;
            letter-spacing: 1px;
            cursor: pointer;
            transition: .25s ease;
            box-shadow: 0 8px 18px rgba(68,68,190,.22);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(68,68,190,.3);
        }

        /* LUPA PASSWORD */
        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #5154D8;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* CATATAN KEAMANAN */
        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border-top: 1px solid #E9ECF2;
            padding-top: 20px;
            margin-top: 25px;
            color: #8A94A7;
            font-size: 11px;
        }

        /* COPYRIGHT */
        .copyright {
            position: fixed;
            bottom: 18px;
            left: 8%;
            color: rgba(255,255,255,.65);
            font-size: 11px;
            letter-spacing: .5px;
        }

        /* ANIMASI */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* RESPONSIVE TABLET DAN HP */
        @media (max-width: 900px) {
            body {
                overflow-y: auto;
                background-attachment: scroll;
            }

            .login-wrapper {
                flex-direction: column;
                justify-content: center;
                gap: 35px;
                padding: 45px 20px 70px;
            }

            .brand-section {
                text-align: center;
            }

            .brand-logos {
                justify-content: center;
                gap: 15px;
                margin-bottom: 25px;
            }

            .brand-logo-dprd {
                width: 85px;
                height: 85px;
            }

            .brand-logo-sipamba {
                width: 200px;
                height: 85px;
            }

            .brand-line {
                margin: 0 auto 20px;
            }

            .brand-section h1 {
                font-size: 31px;
            }

            .brand-section p {
                font-size: 13px;
            }

            .institution {
                display: none;
            }

            .login-card {
                max-width: 440px;
                padding: 30px 25px;
            }

            .copyright {
                position: static;
                width: 100%;
                text-align: center;
                padding: 0 15px 15px;
            }
        }

        @media (max-width: 420px) {
            .login-wrapper {
                padding: 30px 16px 20px;
            }

            .brand-logo-dprd {
                width: 72px;
                height: 72px;
            }

            .brand-logo-sipamba {
                width: 170px;
                height: 72px;
            }

            .brand-section h1 {
                font-size: 27px;
            }

            .login-card {
                padding: 27px 20px;
            }

            .login-heading h2 {
                font-size: 25px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .brand-section,
            .login-card,
            .brand-line {
                animation: none;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <!-- BAGIAN BRANDING -->
    <section class="brand-section">

        <!-- DUA LOGO -->
        <div class="brand-logos">

            <img
                src="{{ asset('images/Logo_DPRD_Riau.png') }}"
                alt="Logo DPRD Provinsi Riau"
                class="brand-logo-dprd"
            >

            <img
                src="{{ asset('images/SIPAMBA Monitoring Dashboard Logo.png') }}"
                alt="Logo SIPAMBA"
                class="brand-logo-sipamba"
            >

        </div>

        <div class="brand-line"></div>

        <h1>
            Pengawasan Pembangunan
            <span>Provinsi Riau</span>
        </h1>

        <p>
            Sistem Informasi Pengawasan dan Monitoring Pembangunan
            sebagai sarana pengelolaan informasi, dokumentasi,
            serta tindak lanjut kegiatan pengawasan pembangunan.
        </p>

        <div class="institution">
            DEWAN PERWAKILAN RAKYAT DAERAH<br>
            PROVINSI RIAU
        </div>

    </section>


    <!-- FORM LOGIN -->
    <section class="login-card">

        <div class="login-heading">
            <div class="eyebrow">Sistem Informasi Pengawasan dan Monitoring Pembangunan</div>

            <h2>SELAMAT DATANG!</h2>

            <p>Silakan masuk untuk melanjutkan ke sistem.</p>
        </div>

        <!-- PESAN STATUS -->
        @if (session('status'))
            <div style="color:#15803d; font-size:13px; margin-bottom:15px;">
                {{ session('status') }}
            </div>
        @endif

        <!-- PESAN ERROR -->
        @if ($errors->any())
            <div style="color:#DC2626; font-size:13px; margin-bottom:15px;">
                Email atau password tidak sesuai. Silakan periksa kembali.
            </div>
        @endif

        <!-- FORM AUTENTIKASI LARAVEL -->
        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- EMAIL -->
            <div class="form-group">

                <label for="email">Alamat Email</label>

                <input
                    id="email"
                    class="form-control"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan alamat email"
                    required
                    autofocus
                    autocomplete="username"
                >

                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            <!-- PASSWORD -->
            <div class="form-group">

                <label for="password">Kata Sandi</label>

                <div class="password-wrapper">

                    <input
                        id="password"
                        class="form-control"
                        type="password"
                        name="password"
                        placeholder="Masukkan kata sandi"
                        required
                        autocomplete="current-password"
                    >

                    <!-- TOMBOL LIHAT PASSWORD -->
                    <button
                        type="button"
                        class="password-toggle"
                        id="togglePassword"
                        aria-label="Tampilkan kata sandi"
                        aria-pressed="false"
                    >

                        <svg
                            id="eyeIcon"
                            xmlns="http://www.w3.org/2000/svg"
                            width="21"
                            height="21"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>

                    </button>

                </div>

                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror

            </div>

            <!-- INGAT SAYA -->
            <div class="remember-row">

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    value="1"
                >

                <label for="remember_me">
                    Ingat saya
                </label>

            </div>

            <!-- TOMBOL MASUK -->
            <button type="submit" class="login-button">
                MASUK KE SIPAMBA
            </button>

            <!-- LUPA PASSWORD -->
            @if (Route::has('password.request'))

                <a
                    class="forgot-link"
                    href="{{ route('password.request') }}"
                >
                    Lupa kata sandi?
                </a>

            @endif

        </form>

        <!-- CATATAN KEAMANAN -->
        <div class="security-note">
            <span>🔒</span>
            Akses sistem terbatas untuk pengguna yang berwenang
        </div>

    </section>

</div>


<!-- COPYRIGHT -->
<div class="copyright">
    © {{ date('Y') }} SIPAMBA · DPRD PROVINSI RIAU
</div>


<!-- JAVASCRIPT TOGGLE PASSWORD -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    if (!password || !toggle || !eyeIcon) {
        return;
    }

    toggle.addEventListener('click', function () {

        const isHidden = password.type === 'password';

        password.type = isHidden ? 'text' : 'password';

        toggle.setAttribute(
            'aria-label',
            isHidden
                ? 'Sembunyikan kata sandi'
                : 'Tampilkan kata sandi'
        );

        toggle.setAttribute('aria-pressed', String(isHidden));

        if (isHidden) {

            eyeIcon.innerHTML = `
                <path d="m3 3 18 18"/>
                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a15 15 0 0 1-3 3.8"/>
                <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7a10 10 0 0 0 4-.8"/>
            `;

        } else {

            eyeIcon.innerHTML = `
                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
            `;

        }

    });

});
</script>

</body>
</html>
