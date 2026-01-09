<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Bimbingan Belajar Quran Teknokrat">
    <meta name="keywords" content="BBQ">
    <title>{{ $title ?? 'Bimbingan Belajar Quran | Teknokrat' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/template_lte/plugins/fontawesome-free/css/all.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="/template_lte/dist/css/adminlte.min.css">

    <link rel="icon" href="/template_lte/img/logo.png">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
        }

        /* ===============================
       FIX UTAMA OVERFLOW MOBILE
       WAJIB ADA (INI YANG BIKIN PUTIH KE KANAN HILANG)
    =============================== */
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
            /* <<< FIX PALING PENTING */
        }

        body {
            scroll-behavior: smooth;
        }

        section {
            padding: 80px 0;
        }

        h4.section-title {
            font-weight: 700;
            letter-spacing: .4px;
        }

        /* ===============================
       NAVBAR
    =============================== */
        .navbar {
            background: rgba(13, 110, 253, .95);
            backdrop-filter: blur(10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
        }

        /* ===============================
       HERO SECTION
    =============================== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-size: cover;
            background-position: center;
            position: relative;

            width: 100%;
            /* <<< PENTING: JANGAN 100vw */
            overflow: hidden;
            /* <<< CEGAH BACKGROUND MELEBAR */
        }

        @media (min-width: 992px) {
            .hero {
                background-image: url("/template_lte/img/cover.png");
            }
        }

        @media (max-width: 991px) {
            .hero {
                background-image: url("/template_lte/img/cover2.png");
            }
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg,
                    rgba(0, 0, 0, .45),
                    rgba(0, 0, 0, .85));
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #fff;

            max-width: 100%;
            /* <<< JAGA-JAGA KONTEN */
        }

        /* ===============================
       CARD GLOBAL
    =============================== */
        .card {
            border-radius: 18px;
        }

        /* ===============================
       INFO LIST
    =============================== */
        .info-list li {
            border: none;
            border-bottom: 1px dashed #ddd;
            padding: 16px 12px;
            /* <<< DITAMBAH SAMPING BIAR GA MEPET */
        }

        /* ===============================
       KEGIATAN
    =============================== */
        .kegiatan .card {
            transition: all .35s ease;
        }

        .kegiatan .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);
        }

        /* ===============================
       FOOTER
    =============================== */
        footer {
            box-shadow: 0 -4px 15px rgba(0, 0, 0, .12);
        }

        footer a {
            transition: .3s;
        }

        footer a:hover {
            color: #cce5ff;
            text-decoration: none;
        }

        /* ===============================
       HOVER EFFECT
    =============================== */
        .hover-scale {
            transition: transform .2s ease;
            display: inline-block;
            /* <<< BIAR TRANSFORM AMAN */
        }

        .hover-scale:hover {
            transform: scale(1.25);
        }

        .hover-scale-sm {
            transition: transform .2s ease;
            /* <<< FIX KECIL TAPI PENTING */
        }

        .hover-scale-sm:hover {
            transform: scale(1.05);
        }

        /* ===============================
       EXTRA SAFETY (OPSIONAL TAPI AMAN)
    =============================== */
        img,
        svg {
            max-width: 100%;
            height: auto;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container">
            <img src="/template_lte/img/brand.png" width="50" class="mr-2">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto text-uppercase align-items-center">
                    <li class="nav-item"><a href="#" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="#info" class="nav-link">Info</a></li>
                    <li class="nav-item"><a href="#kegiatan" class="nav-link">Kegiatan</a></li>
                    <li class="nav-item"><a href="#kontak" class="nav-link">Kontak</a></li>

                    @if (!Auth::user())
                        <li class="nav-item ml-2">
                            <a href="login" class="btn btn-success btn-sm rounded-pill">Login</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a href="pendaftaran" class="btn btn-dark btn-sm rounded-pill">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item ml-2">
                            <a href="login" class="btn btn-info btn-sm rounded-pill">Dashboard</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container hero-content text-center">
            <h1 data-aos="zoom-in">Bimbingan Belajar Qur'an</h1>
            <h3 class="mt-3" data-aos="zoom-in" data-aos-delay="200">
                Gelombang {{ $informasi->gelombang->nomor }} -
                {{ $informasi->gelombang->tahun_akademik }}
            </h3>
            <a href="/pendaftaran" class="btn btn-outline-light btn-lg rounded-pill mt-4" data-aos="fade-up">Daftar
                Sekarang</a>
        </div>
    </section>

    <!-- APA -->
    <section>
        <div class="container">
            <h4 class="section-title text-center mb-4" id="info" data-aos="fade-up">Apa itu BBQ?</h4>
            <div class="row align-items-center" data-aos="zoom-out" data-aos-duration="8000">
                <div class="col-md-4 text-center mb-3">
                    <img src="/template_lte/img/logo.png" width="120">
                </div>
                <div class="col-md-8">
                    <p class="lead">
                        Bimbingan Belajar Qur'an atau lebih dikenal dengan BBQ adalah kegiatan
                        wajib yang bagi mahasiswa yang mengambil mata kuliah <strong>Pendidikan Agama
                            Islam</strong> semester ini. Kegiatan BBQ dijalankan oleh Unit Kegiatan Mahasiswa
                        Islam (UKMI) Ar-Rahman Teknokrat. Selama satu semester mahasiswa akan belajar tidak
                        hanya membaca Quran, tapi juga termasuk aqidah, akhlaq, san saling berbagi pengetahuan
                        kuliah bersama <strong>tutor</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- INFO -->
    <section class="bg-light">
        <div class="container">
            <h4 class="section-title text-center mb-4" data-aos="fade-up" data-aos-duration="1800">Informasi Pendaftaran
            </h4>
            <div class="row align-items-center">
                <div class="col-md-4 mb-3" data-aos="fade-right" data-aos-duration="1800">
                    <img src="{{ asset('storage/pamflet/' . $informasi->pamflet) }}" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-8" data-aos="fade-left" data-aos-duration="1800">
                    <ul class="list-group list-group-flush info-list shadow-sm rounded-lg">

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-calendar-alt text-danger mr-2"></i>
                                <span class="font-weight-semibold">Masa Pendaftaran</span>
                            </div>
                            <strong class="text-muted">
                                {{ indoDateFull($informasi->mulai_daftar) }} –
                                {{ indoDateFull($informasi->akhir_daftar) }}
                            </strong>
                        </li>

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-money-bill-wave text-success mr-2"></i>
                                <span class="font-weight-semibold">Biaya Pendaftaran</span>
                            </div>
                            <span class="badge badge-success badge-pill px-3 py-2">
                                Rp {{ $informasi->biaya }}K
                            </span>
                        </li>

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fab fa-whatsapp text-success mr-2"></i>
                                <span class="font-weight-semibold">Konfirmasi Pembayaran</span>
                            </div>


                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone=62{{ $informasi->wa_konfirmasi }}&text=Assalamu'alaikum kak, nama Saya *...*%0AIngin%20Konfirmasi%20Pembayaran%20Pendaftaran BBQ %20 atas nama *...*%0ATerimakasih.🙏">
                                <span class="badge badge-success badge-pill px-3 py-2 hover-scale">
                                    +62 {{ $informasi->wa_konfirmasi }}K
                                </span>
                            </a>
                        </li>

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-calendar-check text-primary mr-2"></i>
                                <span class="font-weight-semibold">Mulai KBM</span>
                            </div>
                            <strong>
                                {{ indoDateFull($informasi->mulai_kbm) }}
                                <span class="text-danger">*</span>
                            </strong>
                        </li>

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-rocket text-info mr-2"></i>
                                <span class="font-weight-semibold">Launching BBQ</span>
                            </div>
                            <strong>
                                {{ indoDateFull($informasi->launching) }}
                                <span class="text-danger">*</span>
                            </strong>
                        </li>

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-moon text-indigo mr-2"></i>
                                <span class="font-weight-semibold">Mabit</span>
                            </div>
                            <strong>
                                {{ indoDateFull($informasi->mabit) }}
                                <span class="text-danger">*</span>
                            </strong>
                        </li>

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-users text-warning mr-2"></i>
                                <span class="font-weight-semibold">Jalasah</span>
                            </div>
                            <strong>
                                {{ indoDateFull($informasi->jalasah) }}
                                <span class="text-danger">*</span>
                            </strong>
                        </li>

                        <li class="list-group-item  px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-microphone text-secondary mr-2"></i>
                                <span class="font-weight-semibold">BBQ Talkshow</span>
                            </div>
                            <strong>
                                {{ indoDateFull($informasi->talkshow) }}
                                <span class="text-danger">*</span>
                            </strong>
                        </li>

                        <li class="list-group-item  px-4 text-right text-danger small">
                            <i>* tanggal dapat berubah sewaktu-waktu</i>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </section>

    <!-- KEGIATAN -->
    <section class="kegiatan" id="kegiatan">
        <div class="container">
            <h4 class="section-title text-center mb-4" data-aos="fade-up" data-aos-duration="1800">Kegiatan</h4>
            <div class="row">
                @foreach ($kegiatans as $kegiatan)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm" data-aos="fade-up" data-aos-duration="2000">
                            <img src="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="font-weight-bold">{{ $kegiatan->nama_kegiatan }}</h5>
                                <p class="card-text">
                                    <span class="short-text">{{ Str::limit($kegiatan->deskripsi, 100) }}</span>
                                    <span class="full-text d-none">{{ $kegiatan->deskripsi }}</span>
                                </p>
                                <a href="javascript:void(0)" class="toggle-text btn btn-sm btn-outline-primary">
                                    Baca lengkap
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="bg-light">
        <div class="container">
            <h4 class="section-title text-center mb-4" data-aos="zoom-in">
                Kontak
            </h4>
            <hr class="mb-5">

            <div class="row justify-content-center">

                <!-- CP 1 -->
                <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-right">
                    <a href="https://wa.me/62{{ $informasi->cp1 }}" target="_blank" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 hover-scale-sm">
                            <!-- hover pindah ke card-body -->
                            <div class="card-body d-flex justify-content-between align-items-center px-4 py-4">
                                <div>
                                    <div class="text-muted text-sm">WhatsApp</div>
                                    <h5 class="font-weight-bold mb-0">{{ $informasi->nama_cp1 }}</h5>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:52px;height:52px;background:#25D366;">
                                    <i class="fab fa-whatsapp text-white fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- CP 2 -->
                <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-left">
                    <a href="https://wa.me/62{{ $informasi->cp2 }}" target="_blank" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 hover-scale-sm">
                            <div class="card-body d-flex justify-content-between align-items-center px-4 py-4">
                                <div>
                                    <div class="text-muted text-sm">WhatsApp</div>
                                    <h5 class="font-weight-bold mb-0">{{ $informasi->nama_cp2 }}</h5>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:52px;height:52px;background:#25D366;">
                                    <i class="fab fa-whatsapp text-white fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>


            <div class="row justify-content-center ">

                <!-- Instagram -->
                <div class="col-md-4 mb" data-aos="fade-up">
                    <a href="https://www.instagram.com/arrahmanteknokrat/" target="_blank"
                        class="text-decoration-none">
                        <div class="card border-0 shadow-sm hover-scale-sm">
                            <div class="card-body d-flex justify-content-between align-items-center px-4 py-3">
                                <div>
                                    <div class="text-muted text-sm">Instagram</div>
                                    <strong>@arrahmanteknokrat</strong>
                                </div>
                                <i class="fab fa-instagram fa-lg text-danger"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Facebook -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="150">
                    <a href="https://web.facebook.com/ukm.arrahmanteknokrat" target="_blank"
                        class="text-decoration-none">
                        <div class="card border-0 shadow-sm hover-scale-sm">
                            <div class="card-body d-flex justify-content-between align-items-center px-4 py-3">
                                <div>
                                    <div class="text-muted text-sm">Facebook</div>
                                    <strong>LDK Ar-Rahman Teknokrat</strong>
                                </div>
                                <i class="fab fa-facebook fa-lg text-primary"></i>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </section>


    <!-- FOOTER -->
    <footer class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    &copy; 2021 Arrahman
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <a href="/pendaftaran" class="text-white mr-3">Daftar</a>
                    <a href="/login" class="text-white mr-3">Login</a>
                    <a href="https://api.whatsapp.com/send/?phone=6285765842510" target="_blank"
                        class="text-white">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS (TIDAK DIUBAH) -->
    <script src="/template_lte/plugins/jquery/jquery.min.js"></script>
    <script src="/template_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $(document).on('click', '.toggle-text', function() {
            let cardBody = $(this).closest('.card-body');
            cardBody.find('.short-text').toggleClass('d-none');
            cardBody.find('.full-text').toggleClass('d-none');
            $(this).text($(this).text() === 'Baca lengkap' ? 'Tutup' : 'Baca lengkap');
        });
    </script>

</body>

</html>
