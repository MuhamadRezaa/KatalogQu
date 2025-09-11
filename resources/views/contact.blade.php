<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Hubungi tim KatalogQu untuk pertanyaan, dukungan, atau laporan. Kami siap membantu Anda.">
    <meta name="keywords" content="kontak, hubungi kami, support, layanan pelanggan, katalog digital">
    <meta name="author" content="KatalogKu">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/images/katalogqu_icon.png') }}">
    <title>Hubungi Kami - KatalogQu</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .nav-link {
            font-weight: 500;
            color: #495057 !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #478413 !important;
            transform: translateY(-1px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background: linear-gradient(90deg, #478413, #6a9c3b);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .btn-outline-success {
            border: 2px solid #478413;
            color: #478413;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-outline-success:hover {
            background: linear-gradient(45deg, #478413, #6a9c3b);
            border-color: #478413;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(71, 132, 19, 0.3);
        }

        /* Contact Section */
        .contact-section {
            padding: calc(100px + 5rem) 0 80px;
            /* otomatis sesuaikan tinggi navbar */
            position: relative;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="80" cy="40" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="40" cy="80" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(45deg, #478413, #6a9c3b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #478413, #6a9c3b);
            border-radius: 2px;
        }

        .section-description {
            font-size: 1.1rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #478413, #6a9c3b, #478413);
        }

        .contact-info {
            padding: 40px 40px;
            position: relative;
            overflow: hidden;
        }

        .contact-info::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }

        .contact-info h3 {
            font-weight: 400;
            font-size: 1rem;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
            transition: transform 0.3s ease;
        }

        .info-item:hover {
            transform: translateX(10px);
        }

        .info-item .icon {
            font-size: 24px;
            margin-right: 20px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .info-item p {
            margin: 0;
            line-height: 1.7;
            font-size: 1rem;
        }

        .info-item a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .info-item a:hover {
            color: #f99a07;
            text-shadow: 0 0 10px rgba(249, 154, 7, 0.5);
        }

        .social-links {
            margin-top: 40px;
            position: relative;
            z-index: 2;
        }

        .social-links a {
            color: white;
            margin-right: 20px;
            font-size: 28px;
            width: 50px;
            height: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: rgba(249, 154, 7, 0.9);
            transform: scale(1.2) rotate(5deg);
            box-shadow: 0 10px 25px rgba(249, 154, 7, 0.4);
        }

        .contact-form {
            padding: 60px 40px;
            background: rgba(255, 255, 255, 0.8);
        }

        .contact-form h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #478413;
            margin-bottom: 40px;
            position: relative;
        }

        .contact-form h3::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(45deg, #478413, #6a9c3b);
            border-radius: 2px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 15px;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #478413;
            box-shadow: 0 0 0 0.25rem rgba(71, 132, 19, 0.15);
            transform: translateY(-2px);
            background: white;
        }

        .btn-submit {
            background: linear-gradient(45deg, #478413, #6a9c3b);
            border: none;
            color: white;
            font-weight: 600;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1rem;
            box-shadow: 0 10px 30px rgba(71, 132, 19, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(71, 132, 19, 0.4);
            background: linear-gradient(45deg, #5a8b2a, #478413);
        }

        .map-container {
            margin-top: 80px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .map-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(71, 132, 19, 0.1), rgba(106, 156, 59, 0.1));
            pointer-events: none;
            z-index: 1;
        }

        .map-container iframe {
            position: relative;
            z-index: 0;
            filter: contrast(1.1) saturate(1.2);
        }

        /* Footer Styles */
        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 50px 0 10px;
            /* position: relative; */
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="footerPattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23footerPattern)"/></svg>');
            pointer-events: none;
        }

        .footer-section {
            position: relative;
            z-index: 2;
        }

        .footer-section h5 {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 25px;
            color: #fff;
            position: relative;
        }

        .footer-section h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 30px;
            height: 2px;
            background: linear-gradient(45deg, #478413, #6a9c3b);
            border-radius: 1px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 400;
        }

        .footer-links a:hover {
            color: #478413;
            transform: translateX(5px);
        }

        .footer-social a {
            color: #bdc3c7;
            margin-right: 15px;
            font-size: 24px;
            width: 45px;
            height: 45px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: linear-gradient(45deg, #478413, #6a9c3b);
            transform: scale(1.1) rotate(5deg);
            color: white;
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 40px 0 30px;
        }

        .footer-bottom {
            text-align: center;
            color: #95a5a6;
            position: relative;
            z-index: 2;
        }

        .footer-bottom a {
            color: #478413;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .footer-bottom a:hover {
            color: #6a9c3b;
            text-shadow: 0 0 10px rgba(71, 132, 19, 0.5);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .contact-info,
            .contact-form {
                padding: 40px 30px;
            }

            .contact-section {
                padding: 120px 0 60px;
            }

            .map-container {
                margin-top: 60px;
            }
        }

        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        .slide-up {
            animation: slideUp 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu Logo"
                    style="max-height: 50px; width: auto; object-fit: contain;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#demo">Template</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#tutorial">Panduan</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <div class="d-flex gap-2 auth-buttons">
                    @auth
                        {{-- ================= PERBAIKAN DROPDOWN DIMULAI DI SINI ================= --}}
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle d-flex align-items-center gap-2"
                                type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->avatar && !empty(Auth::user()->avatar))
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle"
                                        style="width: 24px; height: 24px;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px; background: #478413; color: white; font-size: 12px;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            {{-- Struktur UL diperbaiki agar sesuai dengan screenshot dan fungsionalitas --}}
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li>
                                    <h6 class="dropdown-header">{{ Auth::user()->email }}</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user fa-fw me-2"></i>Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        {{-- ================= PERBAIKAN DROPDOWN SELESAI ================= --}}
                    @else
                        <a href="/login" class="btn btn-outline-success">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="contact-section">
        <div class="container">
            <div class="section-title text-center mb-5 fade-in">
                <h2>Hubungi Kami</h2>
                <p class="section-description">Punya pertanyaan, kritik, atau saran? Jangan ragu untuk menghubungi kami
                    melalui formulir di bawah ini. Tim kami siap membantu Anda dengan respon yang cepat dan profesional.
                </p>
            </div>

            {{-- Menampilkan pesan sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="map-container slide-up">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d236933.29246405442!2d98.47255029175973!3d3.570878707138689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312fba38d67b9d%3A0x7f2e6e34e630a94e!2sPT.%20Era%20Cipta%20Digital!5e1!3m2!1sen!2sid!4v1757412024428!5m2!1sen!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <br>
            <br>
            <br>

            <div class="contact-card slide-up">
                <div class="row g-0">
                    <div class="col-lg-12">
                        <!-- Form Section yang Perlu Diupdate -->
                        <div class="contact-form">
                            <h3><i class="fas fa-paper-plane me-3"></i>Kirim Pesan</h3>

                            {{-- Menampilkan pesan error jika ada --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST" class="needs-validation"
                                novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}"
                                            maxlength="255" required placeholder="Masukkan nama lengkap Anda">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Alamat Email *</label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            name="email" value="{{ old('email') }}" maxlength="255" required
                                            placeholder="contoh@email.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Email yang valid wajib diisi.</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon</label>
                                        <input type="text"
                                            class="form-control @error('no_telp') is-invalid @enderror" id="phone"
                                            name="no_telp" value="{{ old('no_telp') }}" maxlength="25"
                                            placeholder="Ketik nomor telepon Anda">
                                        @error('no_telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text"><i>*Pastikan nomor telepon yang Anda berikan
                                                masih
                                                aktif!.</i>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="subject" class="form-label">Subjek *</label>
                                        <input type="text"
                                            class="form-control @error('subjek') is-invalid @enderror" id="subject"
                                            name="subjek" value="{{ old('subjek') }}" maxlength="255" required
                                            placeholder="Tulis subjek pesan Anda">
                                        @error('subjek')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="invalid-feedback">Subjek wajib diisi.</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="message" class="form-label">Pesan Anda *</label>
                                    <textarea class="form-control @error('text') is-invalid @enderror" id="message" name="text" rows="6"
                                        maxlength="1000" required placeholder="Tuliskan pesan Anda di sini">{{ old('text') }}</textarea>
                                    @error('text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Pesan wajib diisi.</div>
                                    @enderror
                                    <div class="form-text">
                                        <span id="char-count">0</span>/1.000 karakter
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <script>
                            // Character counter untuk textarea
                            document.addEventListener('DOMContentLoaded', function() {
                                const textarea = document.getElementById('message');
                                const charCount = document.getElementById('char-count');

                                if (textarea && charCount) {
                                    // Update counter saat mengetik
                                    textarea.addEventListener('input', function() {
                                        const currentLength = this.value.length;
                                        charCount.textContent = currentLength.toLocaleString();

                                        // Ubah warna jika mendekati limit
                                        if (currentLength > 9000) {
                                            charCount.style.color = '#dc3545'; // Red
                                        } else if (currentLength > 7000) {
                                            charCount.style.color = '#ffc107'; // Yellow
                                        } else {
                                            charCount.style.color = '#6c757d'; // Gray
                                        }
                                    });

                                    // Set initial count jika ada old input
                                    if (textarea.value) {
                                        textarea.dispatchEvent(new Event('input'));
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-section">
                        <div class="footer-brand mb-4">
                            <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu Logo"
                                style="width: 140px; height: auto;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-6">
                    <div class="footer-section">
                        <h5>Pages</h5>
                        <ul class="footer-links">
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li><a href="{{ url('/') }}#demo">Template</a></li>
                            <li><a href="{{ url('/') }}#features">Fitur</a></li>
                            <li><a href="{{ url('/') }}#tutorial">Panduan</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-2 mb-6">
                    <div class="footer-section">
                        <h5>Kontak Kami</h5>
                        <div class="contact-info mb-2">
                            <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Medan, Sumatera Utara</p>
                            <p class="mb-2"><i class="fas fa-envelope me-2"></i>pteraciptadigital@gmail.com</p>
                            <p class="mb-2"><i class="fas fa-phone me-2"></i><a>08116584545</a></p>
                        </div>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/people/PT-Era-Cipta-Digital/61571510908596/"
                                title="Facebook" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/eracipta.digital/" title="Instagram"
                                target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://wa.me/628116584545" title="WhatsApp" target="_blank"><i
                                    class="fab fa-whatsapp"></i></a>
                            <a href="https://www.youtube.com/watch?si=yKam4Cr8TZpLHwl5&v=lLnvxPIqDp8&feature=youtu.be"
                                title="YouTube" target="_blank"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p>&copy; 2025 <a href="https://pteraciptadigital.id/about" target="_blank">PT. Era Cipta
                                Digital</a>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.slide-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s ease-in-out';
            observer.observe(el);
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.backdropFilter = 'blur(10px)';
                } else {
                    navbar.style.background = 'linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%)';
                    navbar.style.backdropFilter = 'blur(10px)';
                }
            }
        });

        // Add loading animation to submit button
        document.querySelector('form.needs-validation').addEventListener('submit', function(e) {
            if (this.checkValidity()) {
                const submitButton = this.querySelector('.btn-submit');
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                submitButton.disabled = true;
            }
        });


        // Add hover effect to info items
        document.querySelectorAll('.info-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(15px) scale(1.02)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0) scale(1)';
            });
        });

        // Add click animation to social links
        document.querySelectorAll('.social-links a, .footer-social a').forEach(link => {
            link.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Add typing effect to section description
        function typeWriter(element, text, speed = 50) {
            let i = 0;
            element.innerHTML = '';

            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing effect when page loads
        window.addEventListener('load', function() {
            const description = document.querySelector('.section-description');
            if (description) {
                const originalText = description.textContent;
                typeWriter(description, originalText, 30);
            }
        });

        // Add particle effect to contact info background
        function createParticles() {
            const contactInfo = document.querySelector('.contact-info');
            if (!contactInfo) return;

            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = Math.random() * 4 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = 'rgba(255, 255, 255, 0.3)';
                particle.style.borderRadius = '50%';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animation = `float ${Math.random() * 3 + 2}s ease-in-out infinite alternate`;
                particle.style.pointerEvents = 'none';
                contactInfo.appendChild(particle);
            }
        }

        // Add CSS for floating animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0% { transform: translateY(0px) rotate(0deg); opacity: 0.7; }
                100% { transform: translateY(-20px) rotate(360deg); opacity: 0.3; }
            }
        `;
        document.head.appendChild(style);

        // Initialize particles
        createParticles();
    </script>
</body>

</html>
