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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title text-uppercase">{{ $title ?? '' }}</h5>
                                    <div class="card-tools">
                                        <a href="/" class="btn btn-sm btn-success">
                                            <i class="fa fa-home"></i> Beranda
                                        </a>
                                        <a href="{{ route('pendaftaran.lihat') }}" class="btn btn-sm bg-gradient-navy">
                                            <i class="fa fa-eye"></i> Sudah daftar? lihat data pendaftar
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($informasi->status_pendaftaran == 'ditutup')
                                        <div class="callout callout-danger bg-yellow">
                                            <h4 class="alert-heading">Pemberitahuan!</h4>
                                            <p>MOHON MAAF BUKAN MASA PENDAFTARAN BBQ.</p>
                                            <hr>
                                            <p class="mb-0">Harap hubungi panitia BBQ untuk informasi lebih lanjut.
                                            </p>
                                        </div>
                                    @else
                                        <!-- Form -->
                                        <form method="post" action="{{ route('pendaftaran.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="text-center"
                                                            for="pilihGelombang">Gelombang</label>
                                                        <input type="hidden" name="gelombang_id"
                                                            value="{{ $informasi->gelombang_id }}">
                                                        <select class="custom-select " name="gelombang1"
                                                            id="pilihGelombang" disabled>
                                                            <option value="">Gelombang
                                                                {{ $informasi->gelombang->nomor }} -
                                                                {{ $informasi->gelombang->tahun_akademik }}</option>
                                                        </select>
                                                        @error('gelombang_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nama Dosen</label>
                                                        <select
                                                            class="custom-select @error('dosen_id') is-invalid @enderror"
                                                            name="dosen_id" required>
                                                            <option value="">Pilih Dosen</option>
                                                            @foreach ($dosens as $dosen)
                                                                <option value="{{ $dosen->id }}"
                                                                    {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                                                    {{ $dosen->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('dosen_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">NPM</label>
                                                        <input type="text" name="npm"
                                                            class="form-control  @error('npm') is-invalid @enderror"
                                                            id="npm" placeholder="NPM"
                                                            value="{{ old('npm') }}" required>
                                                        @error('npm')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nama Lengkap</label>
                                                        <input type="text" name="nama"
                                                            class="form-control @error('nama') is-invalid @enderror"
                                                            id="exampleFirstName" placeholder="Nama Lengkap"
                                                            value="{{ old('nama') }}" required>
                                                        @error('nama')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nomor WA</label> <small
                                                            class="text-danger">*(08xxxx)</small>
                                                        <input type="number" name="nomor_wa"
                                                            class="form-control @error('nomor_wa') is-invalid @enderror"
                                                            id="exampleInputTelepon" placeholder="Nomor WhatsApp"
                                                            value="{{ old('nomor_wa') }}" required>
                                                        @error('nomor_wa')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group ">
                                                        <label class="text-center" for="pilihJenisKelamin">Jenis
                                                            Kelamin</label>
                                                        <select
                                                            class="custom-select mr-sm-2 @error('jk') is-invalid @enderror"
                                                            name="jk" id="pilihJenisKelamin" required>
                                                            <option value="">Pilih Jenis Kelamin</option>
                                                            <option value="laki-laki"
                                                                {{ old('jk') == 'laki-laki' ? 'selected' : '' }}>
                                                                Laki-Laki
                                                            </option>
                                                            <option value="perempuan"
                                                                {{ old('jk') == 'perempuan' ? 'selected' : '' }}?>
                                                                Perempuan
                                                            </option>
                                                        </select>
                                                        @error('jk')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- pilihan jurusan -->
                                                    <div class="form-group ">
                                                        <label class="text-center" for="pilihJurusan">Jurusan</label>
                                                        <select class="custom-select mr-sm-2 r" name="jurusan_id"
                                                            required>
                                                            <option value="">Pilih Jurusan</option>
                                                            @foreach ($jurusans as $jurusan)
                                                                <option value="{{ $jurusan->id }}"
                                                                    {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                                    {{ $jurusan->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('jurusan_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- pilihan Kelas -->
                                                    <div class="form-group ">
                                                        <label class="text-center" for="pilihKelas">Kelas</label>
                                                        <select
                                                            class="custom-select mr-sm-2 @error('kelas_id') is-invalid @enderror"
                                                            name="kelas_id" id="pilihKelas" required>
                                                            <option value="">Pilih Kelas</option>
                                                            @foreach ($kelass as $kelas)
                                                                <option value="{{ $kelas->id }}"
                                                                    {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                                                    {{ $kelas->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('kelas_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- pilihan Kelancaran -->
                                                    <div class="form-group ">
                                                        <label class="text-center" for="pilihKelancaran">Kelancaran
                                                            Mengaji</label>
                                                        <select
                                                            class="custom-select mr-sm-2 @error('kelancaran_mengaji') is-invalid @enderror"
                                                            name="kelancaran_mengaji" id="pilihKelancaran" required>
                                                            <option value="">Pilih Kelancaran</option>
                                                            <option value="Lancar"
                                                                {{ old('kelancaran_mengaji') == 'Lancar' ? 'selected' : '' }}>
                                                                Lancar</option>
                                                            <option value="Terbata Bata"
                                                                {{ old('kelancaran_mengaji') == 'Terbata Bata' ? 'selected' : '' }}>
                                                                Terbata Bata</option>
                                                            <option value="Tidak Bisa Membaca"
                                                                {{ old('kelancaran_mengaji') == 'Tidak Bisa Membaca' ? 'selected' : '' }}>
                                                                Tidak Bisa Membaca</option>
                                                        </select>
                                                        @error('kelancaran_mengaji')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="jadwal">Upload Gambar Jadwal Kuliah
                                                            <small class="text-danger">(jpg,jpeg,gif,png')</small>
                                                        </label><br>
                                                        <input type="file" accept="image/*" name="jadwal_kuliah"
                                                            class="form-control @error('jadwal_kuliah') is-invalid @enderror"
                                                            value="{{ old('jadwal_kuliah') }}" required>
                                                        @error('jadwal_kuliah')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user  mt-2">
                                                <strong><i class="fa fa-paper-plane"></i> Submit Data
                                                    Pendaftaran</strong>
                                            </button>
                                            <hr>
                                        </form>
                                    @endif


                                    <div class="col-md-12 d-flex justify-content-md-center">
                                        <a href="{{ route('pendaftaran.lihat') }}"
                                            class="btn btn-success btn-icon-split float-right">
                                            <span class="icon d-flex align-middle align-items-center">
                                                <i class="fas fa-clipboard-list-check"></i>
                                            </span>
                                            <span class="text">Sudah daftar? lihat data pendaftar </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

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
