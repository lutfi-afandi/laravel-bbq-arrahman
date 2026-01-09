<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Pendaftaran BBQ' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template_lte/dist/css/adminlte.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('template_lte/img/logo.png') }}">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md  navbar-light  navbar-primary">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="{{ asset('template_lte/img/brand.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-2" style="opacity: 1">
                    <span class="brand-text font-weight-light text-light"><strong>BBQ</strong> Teknokrat</span>
                </a>

            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">

                    {{-- HEADER --}}
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <h3 class="font-weight-bold mb-1 text-primary">
                                📝 {{ $title ?? 'Pendaftaran BBQ' }}
                            </h3>
                            <p class="text-muted mb-0">
                                Silakan lengkapi data berikut dengan benar
                            </p>
                        </div>
                    </div>


                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            <div class="card card-primary card-outline shadow-sm">
                                <div class="card-header ">
                                    <strong>Form Pendaftaran</strong>
                                    <div class="card-tools mr-1">
                                        <a href="/" class="btn btn-sm btn-success">
                                            <i class="fa fa-home"></i> Beranda
                                        </a>
                                        <a href="{{ route('pendaftaran.lihat') }}" class="btn btn-sm bg-gradient-navy">
                                            <i class="fa fa-eye"></i> Lihat Data
                                        </a>
                                    </div>
                                </div>

                                <div class="card-body">

                                    {{-- ALERT --}}
                                    @includeWhen(session('success'), 'partials.alert-success')
                                    @includeWhen(session('error'), 'partials.alert-error')

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    {{-- PENDAFTARAN DITUTUP --}}
                                    @if ($informasi->status_pendaftaran == 'ditutup')
                                        <div class="callout callout-warning">
                                            <h5><i class="fas fa-exclamation-circle"></i> Pendaftaran Ditutup</h5>
                                            <p class="mb-0">
                                                Saat ini pendaftaran BBQ sudah ditutup.
                                                Silakan hubungi panitia untuk info lebih lanjut.
                                            </p>
                                        </div>
                                    @else
                                        <form method="post" action="{{ route('pendaftaran.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            {{-- ================= INFORMASI AKADEMIK ================= --}}
                                            <div class="card card-outline card-info mb-3">
                                                <div class="card-header">
                                                    <strong>📘 Informasi Akademik</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Gelombang</label>
                                                            <input type="hidden" name="gelombang_id"
                                                                value="{{ $informasi->gelombang_id }}">
                                                            <select class="custom-select" disabled>
                                                                <option>
                                                                    Gelombang {{ $informasi->gelombang->nomor }} -
                                                                    {{ $informasi->gelombang->tahun_akademik }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Nama Dosen</label>
                                                            <select name="dosen_id"
                                                                class="custom-select @error('dosen_id') is-invalid @enderror"
                                                                required>
                                                                <option value="">Pilih Dosen</option>
                                                                @foreach ($dosens as $dosen)
                                                                    <option value="{{ $dosen->id }}"
                                                                        {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                                                        {{ $dosen->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- ================= DATA PRIBADI ================= --}}
                                            <div class="card card-outline card-success mb-3">
                                                <div class="card-header">
                                                    <strong>👤 Data Pribadi</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>NPM</label>
                                                            <input type="text" name="npm"
                                                                class="form-control @error('npm') is-invalid @enderror"
                                                                value="{{ old('npm') }}" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Nama Lengkap</label>
                                                            <input type="text" name="nama"
                                                                class="form-control @error('nama') is-invalid @enderror"
                                                                value="{{ old('nama') }}" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Nomor WhatsApp</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">+62</span>
                                                                </div>
                                                                <input type="number" name="nomor_wa"
                                                                    class="form-control @error('nomor_wa') is-invalid @enderror"
                                                                    placeholder="8xxxxxxxxx"
                                                                    value="{{ old('nomor_wa') }}" required>
                                                            </div>
                                                            @error('nomor_wa')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>


                                                        <div class="col-md-6">
                                                            <label>Jenis Kelamin</label>
                                                            <select name="jk"
                                                                class="custom-select @error('jk') is-invalid @enderror"
                                                                required>
                                                                <option value="">Pilih</option>
                                                                <option value="laki-laki"
                                                                    {{ old('jk') == 'laki-laki' ? 'selected' : '' }}>
                                                                    Laki-laki</option>
                                                                <option value="perempuan"
                                                                    {{ old('jk') == 'perempuan' ? 'selected' : '' }}>
                                                                    Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- ================= DATA TAMBAHAN ================= --}}
                                            <div class="card card-outline card-warning mb-4">
                                                <div class="card-header">
                                                    <strong>📂 Data Tambahan</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Jurusan</label>
                                                            <select name="jurusan_id" class="custom-select" required>
                                                                <option value="">Pilih Jurusan</option>
                                                                @foreach ($jurusans as $jurusan)
                                                                    <option value="{{ $jurusan->id }}"
                                                                        {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                                        {{ $jurusan->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Kelas</label>
                                                            <select name="kelas_id" class="custom-select" required>
                                                                <option value="">Pilih Kelas</option>
                                                                @foreach ($kelass as $kelas)
                                                                    <option value="{{ $kelas->id }}"
                                                                        {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                                                        {{ $kelas->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Kelancaran Mengaji</label>
                                                            <select name="kelancaran_mengaji" class="custom-select"
                                                                required>
                                                                <option value="">Pilih</option>
                                                                <option value="Lancar">Lancar</option>
                                                                <option value="Terbata Bata">Terbata Bata</option>
                                                                <option value="Tidak Bisa Membaca">Tidak Bisa Membaca
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Upload Jadwal Kuliah</label>
                                                            <input type="file" name="jadwal_kuliah"
                                                                accept="image/*"
                                                                class="form-control @error('jadwal_kuliah') is-invalid @enderror"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- SUBMIT --}}
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                                    <i class="fa fa-paper-plane"></i> Submit Pendaftaran
                                                </button>
                                            </div>

                                        </form>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> Laravel
            </div>
            <strong>Copyright &copy; 2025 <a href="https://wa.me/6285765842510">Kader UKMI</a>.</strong> All rights
            reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('template_lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables -->
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template_lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template_lte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            })
        }, 3500);
    </script>

    <script>
        function bacaGambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('gambar_load').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#preview_gambar').change(function() {
            bacaGambar(this);
        });
    </script>
    @if (session('swal_icon'))
        <script>
            Swal.fire({
                icon: "{{ session('swal_icon') }}",
                title: "{{ session('swal_title') }}",
                text: "{{ session('swal_text') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif


</body>

</html>
