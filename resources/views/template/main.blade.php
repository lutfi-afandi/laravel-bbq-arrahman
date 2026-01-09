<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Bimbingan Belajar Quran Teknokrat' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template_lte/dist/css/adminlte.min.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('template_lte/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template_lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- InputMask -->
    <script src="{{ asset('template_lte/plugins/moment/moment.min.js') }}"></script>
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/daterangepicker/daterangepicker.css') }}">

    <style>
        .btn-primary {
            background: linear-gradient(135deg, #424fc1, #007bff);
            border: none;
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #ff6b6b);
            border: none;
        }

        .bg-primary {
            background: linear-gradient(135deg, #424fc1, #007bff);
            border: none;
        }

        .bg-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            border: none;
        }

        .bg-danger {
            background: linear-gradient(135deg, #dc3545, #ff6b6b);
            border: none;
        }
    </style>
    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header  navbar navbar-expand  navbar-primary navbar-dark p-1 border-bottom-0">
            <ul class="navbar-nav  p-1">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                @if (Auth::user())
                    <li class="nav-item">
                    <li class="nav-link">{{ Auth::user()->name }} </li>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-id-card"></i>
                        {{-- <span class="badge badge-success navbar-badge">...</span> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Hai, {{ auth()->user()->name }}</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('perbarui_password') }}" class="dropdown-item "><i
                                class="dropdown-icon fa fa-key"></i>&nbsp;&nbsp;Change
                            Password</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer bg-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fa fa-power-off"></i>&nbsp;&nbsp;Log
                            Out</a>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf</form>

                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        @include('template.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                @yield('content-header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('template_lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template_lte/dist/js/adminlte.min.js') }}"></script>
    <!-- DataTables -->
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template_lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 -->
    <script src="{{ asset('template_lte/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('template_lte/plugins/moment/moment.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('template_lte/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    </script>

    @stack('js')
</body>

</html>
