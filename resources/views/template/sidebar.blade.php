<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="#" class="brand-link bg-primary">
        <img src="{{ asset('template_lte/img/brand.png') }}" alt=" Logo" class="brand-image " style="">
        <span class="brand-text font-weight-light"><strong>BBQ</strong> Teknokrat</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-2 pb-2  d-flex">
            <div class="image">
                @php
                    if (Auth::user()->jenis_kelamin == 'laki-laki') {
                        $img = 'template_lte/img/ikhwan.jpg';
                    } else {
                        $img = 'template_lte/img/akhwat.jpg';
                    }
                @endphp
                <img src="{{ asset($img) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Admin -->
        @if (Auth::user()->role == 'admin')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>


                    <li class="nav-header">Peserta</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.peserta.index') }}"
                            class="nav-link  {{ request()->is('admin/peserta') ? 'active' : '' }}">
                            <i class="fa fa-users nav-icon"></i>
                            <p>Data Peserta</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.peserta.kbm') }}"
                            class="nav-link  {{ request()->is('admin/peserta-kbm') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar nav-icon"></i>
                            <p>Data KBM</p>
                        </a>
                    </li>

                    <li class="nav-header">Kelola</li>
                    <li class="nav-item">

                    <li class="nav-item">
                        <a href="{{ route('admin.tutor.index') }}"
                            class="nav-link  {{ request()->is('admin/tutor') ? 'active' : '' }}">
                            <i class="fa fa-chalkboard-teacher nav-icon"></i>
                            <p>Tutor</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.jadwal.index') }}"
                            class="nav-link  {{ request()->is('admin/jadwal') ? 'active' : '' }}">
                            <i class="fa fa-calendar-alt nav-icon"></i>
                            <p>Jadwal Tutor</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.informasi.index') }}"
                            class="nav-link  {{ request()->is('admin/informasi') ? 'active' : '' }}">
                            <i class="fa fa-info-circle nav-icon"></i>
                            <p>Informasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.kegiatan.index') }}"
                            class="nav-link  {{ request()->is('admin/kegiatan') ? 'active' : '' }}">
                            <i class="fa fa-calendar-check nav-icon"></i>
                            <p>Kegiatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#'Admin/Laporan" class="nav-link">
                            <i class="fa fa-list nav-icon"></i>
                            <p>Laporan KBM</p>
                        </a>
                    </li>
                    </li>

                    <li class="nav-header">User</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}"
                            class="nav-link  {{ request()->is('admin/user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('perbarui_password') }}"
                            class="nav-link  {{ request()->is('perbarui-password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Update Password</p>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif

        <!-- Sidebar Tutor -->
        @if (Auth::user()->role == 'tutor')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ request()->is('tutor/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tutor.laporan.index') }}"
                            class="nav-link {{ request()->is('tutor/laporan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Laporan</p>
                        </a>
                    </li>

                    <li class="nav-header">Akun</li>

                    <li class="nav-item">
                        <a href="{{ route('perbarui_password') }}"
                            class="nav-link  {{ request()->is('perbarui-password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Update Password</p>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif

        <!-- Sidebar Peserta -->
        @if (Auth::user()->role == 'mahasiswa')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link  {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">Akun</li>
                    <li class="nav-item">
                        <a href="/perbarui-password"
                            class="nav-link  {{ request()->is('perbarui-password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola akun</p>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
