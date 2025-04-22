<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Bimbingan Belajar Quran Teknokrat">
    <meta name="keywords" content="BBQ" />
    <title>{{ $title ?? 'Bimbingan Belajar Quran | Teknokrat' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/template_lte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/template_lte/dist/css/adminlte.min.css">


    <link rel="icon" type="image/x-icon" href="/template_lte/img/logo.png">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        @media (min-width: 992px) {
            .jumbotron {
                background-image: url("template_lte/img/cover.png");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 680px;
                width: 100%;
                font-family: Arial, Helvetica, sans-serif;
                margin-top: 20px;
            }

            h1,
            h3 {
                font-weight: bolder;
                color: aliceblue;
            }
        }

        @media (max-width: 992px) {
            .jumbotron {
                background-image: url("template_lte/img/cover2.png");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 530px;
                font-family: Arial, Helvetica, sans-serif;
                margin-top: 20px;
            }

            h1,
            h3 {
                font-weight: bolder;
                color: aliceblue;
            }
        }
    </style>
</head>

<body>


    <!-- Nav -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary layout-footer-fixed">
        <div class="container">
            <img src="/template_lte/img/brand.png" class="navbar-brand pt-0 pb-0" alt="" width="50px">
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav text-center ml-auto mt-2 mt-lg-0 text-uppercase ">
                    <li class="nav-item active mr-2">
                        <a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link text-white" href="#info">Info</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link text-white" href="#kegiatan" tabindex="-1">Kegiatan</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link  text-white" href="#kontak" tabindex="-1">Kontak</a>
                    </li>

                    @if (!Auth::user())
                        <li class="nav-item mr-2">
                            <a class="nav-link btn bg-gradient-success btn-sm  text-white hover rounded-pill mb-1 "
                                href="login" tabindex="-1">Login</a>
                        </li>
                        <li class="nav-item mr-2">
                            <a class="nav-link btn bg-gradient-navy btn-sm hover rounded-pill text-white"
                                href="pendaftaran" tabindex="-1">Daftar</a>
                        </li>
                    @else
                        <a class="nav-link btn btn-info btn-sm hover rounded-pill text-white" href="login"
                            tabindex="-1">Dashboard</a>
                    @endif

                </ul>
            </div>
        </div>

    </nav>

    <!-- header -->
    <div class="jumbotron jumbotron-fluid " style="margin-top:0; margin-bottom: 16px;">
        <div class="container text-center " style="margin-top: 150px;">
            <h1 class="" data-aos="zoom-in" data-aos-duration="2000">Bimbingan Belajar Qur'an</h1>
            <h3 class="p-jum" data-aos="zoom-in" data-aos-duration="1500">Gelombang
                {{ $informasi->gelombang->nomor . ' - ' . $informasi->gelombang->tahun_akademik }}
            </h3>
            <a href="/pendaftaran" class="btn btn-primary hover rounded-pill mt-3" data-aos="fade-up"
                data-aos-duration="2000">Daftar Sekarang!</a>
        </div>
    </div>

    <!-- Apa itu BBQ -->
    <div class="apa">
        <div class="container">
            <div class="row d-flex justify-content-center  ">
                <h4 class="p-info mb-1 font-weight-bold" id="info" data-aos="fade-up">Apa itu BBQ?</h4>

            </div>
            <hr>
            <div class="row" data-aos="zoom-out" data-aos-duration="8000">
                <div class="col-md-4 d-flex justify-content-center align-middle">
                    <div class="item-icon mb-4 ">
                        <img src="{{ asset('template_lte/img/logo.png') }}" class="navbar-brand" alt=""
                            width="100px">

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="item-icon mb-4 d-flex ">
                        <div class="d-flex align-content-between">
                            <p class=" ">Bimbingan Belajar Qur'an atau lebih dikenal dengan BBQ adalah kegiatan
                                wajib yang bagi mahasiswa yang mengambil mata kuliah <strong>Pendidikan Agama
                                    Islam</strong> semester ini. Kegiatan BBQ dijalankan oleh Unit Kegiatan Mahasiswa
                                Islam (UKMI) Ar-Rahman Teknokrat. Selama satu semester mahasiswa akan belajar tidak
                                hanya membaca Quran, tapi juga termasuk aqidah, akhlaq, san saling berbagi pengetahuan
                                kuliah bersama <strong>tutor</strong></p>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- INFO Pendaftaran -->
    <div class="info bg-light pt-2">
        <div class="container">
            <div class="row d-flex justify-content-center  ">
                <h4 class="p-info font-weight-bold" id="info" data-aos="fade-up" data-aos-duration="1800">
                    Informasi Pendaftaran</h4>
            </div>
            <div class="row ">
                <div class="col-md-4" data-aos="fade-right" data-aos-duration="1800">
                    <img src="{{ asset('storage/pamflet/' . $informasi->pamflet) }}" class="img img-thumbnail">
                </div>
                <div class="col-md-8 mb-3" data-aos="fade-left" data-aos-duration="1800">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fa fa-lg fa-calendar-alt mr-3 text-danger"></i>Masa
                            Pendaftaran : <strong class="ml-4 float-right">
                                {{ indoDateFull($informasi->mulai_daftar) }} -
                                {{ indoDateFull($informasi->akhir_daftar) }}</strong>
                        </li>
                        <li class="list-group-item"><i class="fa fa-money-bill-wave-alt mr-3 text-primary"></i>Biaya
                            Pendaftaran :
                            <strong style="color: white; font-size: 1.5rem;"
                                class="ml-4 badge badge-success float-right">Rp. {{ $informasi->biaya }}K</strong>
                        </li>
                        <li class="list-group-item"><i class="fa fa-address-card mr-3 text-success"></i>Konfirmasi :
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone=62{{ $informasi->wa_konfirmasi }}&text=Assalamu'alaikum kak, nama Saya *...*%0AIngin%20Konfirmasi%20Pembayaran%20Pendaftaran BBQ %20 atas nama *...*%0ATerimakasih.🙏"
                                class="btn btn-success btn-icon-split float-right">
                                <span class="icon text-white-50 kon">
                                    <i class="fab fa-whatsapp"></i>
                                </span>
                                <span class="text"><strong> '+62'{{ $informasi->wa_konfirmasi }}</strong> </span>
                            </a>
                        </li>
                        <li class="list-group-item"><i class="fa fa-lg fa-calendar-alt mr-3 text-[edit]"></i>Mulai KBM
                            :
                            <strong class="ml-4 float-right">{{ indoDateFull($informasi->mulai_kbm) }}<span
                                    class="text-danger">*</span>
                            </strong>
                        </li>
                        <li class="list-group-item"><i class="fa fa-lg fa-calendar-alt mr-3 text-[edit]"></i>Launching
                            BBQ :
                            <strong class="ml-4 float-right">{{ indoDateFull($informasi->launching) }} <span
                                    class="text-danger">*</span>
                            </strong>
                        </li>
                        <li class="list-group-item"><i class="fa fa-lg fa-calendar-alt mr-3 text-[edit]"></i>Mabit :
                            <strong class="ml-4 float-right">{{ indoDateFull($informasi->mabit) }} <span
                                    class="text-danger">*</span>
                            </strong>
                        </li>
                        <li class="list-group-item"><i class="fa fa-lg fa-calendar-alt mr-3 text-"></i>Jalasah :
                            <strong class="ml-4 float-right">{{ indoDateFull($informasi->jalasah) }}<span
                                    class="text-danger">*</span>
                            </strong>
                        </li>
                        <li class="list-group-item"><i class="fa fa-lg fa-calendar-alt mr-3 text-"></i>BBQ
                            Talkshow :
                            <strong class="ml-4 float-right">{{ indoDateFull($informasi->talkshow) }} <span
                                    class="text-danger">*</span>
                            </strong>
                        </li>
                        <li class="list-group-item"><i class="text-danger">[*] tanggal bisa berubah</i></li>

                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Kegiatan -->
    <div class="kegiatan mt-2">
        <div class="container">
            <div class="row d-flex justify-content-center  ">
                <h4 class="p-info mb-1 font-weight-bold" id="kegiatan" data-aos="fade-up" data-aos-duration="1800">
                    Kegiatan</h4>
            </div>
            <hr>

            <div class="row">
                @if ($kegiatans->isEmpty())
                    <button class="btn btn-outline-primary btn-block p-4 text-xl mb-2">Kegiatan BBQ</button>
                @else
                    @foreach ($kegiatans as $kegiatan)
                        <div class="col-md-4">
                            <div class="card" data-aos="fade-up" data-aos-duration="2000">
                                <img src="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}" class="card-img-top"
                                    alt="">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <h4>{{ $kegiatan->nama_kegiatan }}</h4>
                                    </h5>
                                    <p class="card-text">{{ $kegiatan->deskripsi }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif

            </div>

        </div>
    </div>

    <!-- kontak -->
    <div class="kontak bg-light  pt-2">
        <div class="container">
            <div class="row d-flex justify-content-center  ">
                <h4 class="p-info font-weight-bold" id="kontak" data-aos="zoom-in" data-aos-duration="2000">
                    Kontak</h4>
            </div>
            <div class="row d-flex justify-content-center">

                <div class="col-xl-3 col-md-6 mb-4" id="ig" data-aos="fade-left" data-aos-duration="1800">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><a target="_blank"
                                            href="http://wa.me/62{{ $informasi->cp1 }}" id="ig"
                                            class="h5 mb-0 font-weight-bold text-gray-800">{{ $informasi->nama_cp1 }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fab fa-whatsapp  fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4" id="ig" data-aos="fade-right" data-aos-duration="1800">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><a target="_blank"
                                            href="http://wa.me/62{{ $informasi->cp2 }}" id="ig"
                                            class="h5 mb-0 font-weight-bold text-gray-800">{{ $informasi->nama_cp2 }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fab fa-whatsapp fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4" id="ig" data-aos="fade-down" data-aos-duration="1800">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><a
                                            href="https://www.instagram.com/arrahmanteknokrat/" target="_blank"
                                            id="ig"
                                            class="h5 mb-0 font-weight-bold text-gray-800">@arrahmanteknokrat</a></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fab fa-instagram fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4" id="ig" data-aos="fade-up" data-aos-duration="1800">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><a
                                            href="https://web.facebook.com/ukm.arrahmanteknokrat" target="_blank"
                                            id="ig" class="h5 mb-0 font-weight-bold text-gray-800">LDK
                                            Ar-Rahman Teknokrat</a></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fab fa-facebook fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <footer class="d-flex justify-content-center mt-5 bg-blue-600">&copy; arrahman - 2021</footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write(
            '<script src="/assets/home/site/docs/4.1/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('template_lte/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
