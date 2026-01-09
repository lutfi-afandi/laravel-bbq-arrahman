<aside class="main-sidebar sidebar-light-primary elevation-0">

    <a href="/" class="brand-link bg-primary d-flex align-items-center">
        <img src="{{ asset('template_lte/img/brand.png') }}" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-bold ml-2"><strong>BBQ</strong> Teknokrat</span>
    </a>

    <div class="sidebar">

        {{-- User Panel --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                @php
                    $img =
                        Auth::user()->jenis_kelamin == 'laki-laki'
                            ? 'template_lte/img/ikhwan.jpg'
                            : 'template_lte/img/akhwat.jpg';
                @endphp
                <img src="{{ asset($img) }}" class="img-circle elevation-1">
            </div>

            <div class="info ml-2">
                <a href="#" class="d-block font-weight-bold">
                    {{ Auth::user()->name }}
                    <i class="fas fa-circle text-success ml-1" style="font-size:8px"></i>
                </a>
                <span class="badge badge-pill badge-primary mt-1">
                    {{ strtoupper(Auth::user()->role) }}
                </span>
            </div>
        </div>

        {{-- ================= ADMIN ================= --}}
        @if (Auth::user()->role == 'admin')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact">

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">Peserta</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.peserta.index') }}"
                            class="nav-link {{ request()->is('admin/peserta') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Peserta</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.peserta.kbm') }}"
                            class="nav-link {{ request()->is('admin/peserta-kbm') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Data KBM</p>
                        </a>
                    </li>

                    <li class="nav-header">Kelola</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.tutor.index') }}"
                            class="nav-link {{ request()->is('admin/tutor') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Tutor</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.jadwal.index') }}"
                            class="nav-link {{ request()->is('admin/jadwal') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Jadwal Tutor</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/cetak" class="nav-link {{ request()->is('admin/cetak') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-print"></i>
                            <p>Cetak Report</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.kegiatan.index') }}"
                            class="nav-link {{ request()->is('admin/kegiatan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Kegiatan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.index') }}"
                            class="nav-link {{ request()->is('admin/laporan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Laporan KBM</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.informasi.index') }}"
                            class="nav-link {{ request()->is('admin/informasi') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Pengaturan & Informasi</p>
                        </a>
                    </li>

                    <li class="nav-header">User</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}"
                            class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola Pengguna</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('perbarui_password') }}"
                            class="nav-link {{ request()->is('perbarui-password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Update Password</p>
                        </a>
                    </li>

                </ul>
            </nav>
        @endif

        {{-- ================= TUTOR ================= --}}
        @if (Auth::user()->role == 'tutor')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact">

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
                            class="nav-link {{ request()->is('perbarui-password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Update Password</p>
                        </a>
                    </li>

                </ul>
            </nav>
        @endif

        {{-- ================= MAHASISWA ================= --}}
        @if (Auth::user()->role == 'mahasiswa')
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact">

                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header">Akun</li>

                    <li class="nav-item">
                        <a href="/perbarui-password"
                            class="nav-link {{ request()->is('perbarui-password') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola Akun</p>
                        </a>
                    </li>

                </ul>
            </nav>
        @endif

    </div>
</aside>
