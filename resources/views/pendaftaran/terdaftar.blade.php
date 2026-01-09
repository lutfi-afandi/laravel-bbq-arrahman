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


    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template_lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

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
                                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-sm bg-gradient-navy">
                                            <i class="fa fa-note"></i> Daftar
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped " id="data-pendaftar">
                                            <thead>
                                                <tr class="bg-maroon">
                                                    <th scope="col">#</th>
                                                    <th class="th-sm">Nama Lengkap</th>
                                                    <th class="th-sm">Kelas</th>
                                                    <th class="th-sm">Kelancaran</th>
                                                    <th class="th-sm">Jenis Kelamin</th>
                                                    <th>Gelombang</th>
                                                    <th class="th-sm">Jadwal BBQ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mahasiswas as $mahasiswa)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <span class="d-block font-weight-bold">
                                                                {{ $mahasiswa->nama }}
                                                            </span>
                                                            <span class="d-block text-muted small">
                                                                NPM: {{ $mahasiswa->npm }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $mahasiswa->jurusan->kode . ' - ' . $mahasiswa->kelas->nama }}
                                                        <td>{{ $mahasiswa->kelancaran_mengaji }}
                                                        <td>{{ ucwords($mahasiswa->jk) }}
                                                        <td>{{ $mahasiswa->gelombang->tahun_akademik . '-' . $mahasiswa->gelombang->nomor }}

                                                        <td>
                                                            <span class="d-block fw-semibold">
                                                                Tutor:
                                                                {{ $mahasiswa->kelompok->jadwal->tutor->name ?? '' }}
                                                            </span>
                                                            <span class="d-block text-muted small">
                                                                {{ $mahasiswa->kelompok->jadwal->waktu->hari ?? '' }}:
                                                                {{ $mahasiswa->kelompok->jadwal->waktu->jam ?? '' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
            $('#data-pendaftar').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    emptyTable: "Belum ada data pendaftar",
                    "search": "", // hilangkan label search
                    "searchPlaceholder": "Cari...", // placeholder di input search
                    lengthMenu: "Tampil _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });


            $('#example').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'booststrap4': true
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
