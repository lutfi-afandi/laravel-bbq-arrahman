@extends('template.main')

@section('content-header')
    <marquee behavior="Scroll " direction="left" scrollamount="10">
        <p class="ml-auto ml-md-3 my-2 my-md-0 text-success font-italic">Selamat Datang {{ auth()->user()->name }} - Sistem
            Informasi Bimbingan
            Belajar Qur'an Teknokrat. Dikelola Oleh Unit Kegiatan Mahasiswa Islam
        </p>
    </marquee>
@endsection
@section('content')
    @php
        $colors = [
            'bg-primary',
            'bg-success',
            'bg-info',
            'bg-warning',
            'bg-danger',
            'bg-dark',
            'bg-navy',
            'bg-indigo',
            'bg-purple',
            'bg-pink',
            'bg-orange',
            'bg-teal',
            'bg-olive',
            'bg-maroon',
            'bg-lime',
            'bg-fuschia',
        ];
    @endphp
    @php
        // Ambil warna secara acak
        $randomColor = $colors[array_rand($colors)];
    @endphp
    <div class="row">

        <div class="col-lg-3 col-xs-6">
            <div class="small-box {{ $colors[array_rand($colors)] }}">
                <div class="inner">
                    <a href="{{ route('admin.tutor.index') }}" style="text-decoration: none; color: currentColor;">
                        <h3>Tutor</h3>
                        <p>BBQ</p>
                    </a>
                </div><a href="{{ route('admin.tutor.index') }}" style="text-decoration: none; color: currentColor;">
                    <div class="icon">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box {{ $colors[array_rand($colors)] }}">
                <div class="inner">
                    <a href="{{ route('admin.peserta.index') }}" style="text-decoration: none; color: currentColor;">
                        <h3>Peserta</h3>
                        <p>BBQ</p>
                    </a>
                </div><a href="{{ route('admin.peserta.index') }}" style="text-decoration: none; color: currentColor;">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box {{ $colors[array_rand($colors)] }}">
                <div class="inner">
                    <a href="{{ route('admin.jadwal.index') }}" style="text-decoration: none; color: currentColor;">
                        <h3>Jadwal Tutor</h3>
                        <p>BBQ</p>
                    </a>
                </div><a href="{{ route('admin.jadwal.index') }}" style="text-decoration: none; color: currentColor;">
                    <div class="icon">
                        <i class="fa fa-calendar-alt"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box {{ $colors[array_rand($colors)] }}">
                <div class="inner">
                    <a href="{{ route('admin.informasi.index') }}" style="text-decoration: none; color: currentColor;">
                        <h3>Informasi</h3>
                        <p>BBQ</p>
                    </a>
                </div><a href="{{ route('admin.informasi.index') }}" style="text-decoration: none; color: currentColor;">
                    <div class="icon">
                        <i class="fa fa-info-circle"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box {{ $colors[array_rand($colors)] }}">
                <div class="inner">
                    <a href="{{ route('admin.kegiatan.index') }}" style="text-decoration: none; color: currentColor;">
                        <h3>Kegiatan</h3>
                        <p>BBQ</p>
                    </a>
                </div><a href="{{ route('admin.kegiatan.index') }}" style="text-decoration: none; color: currentColor;">
                    <div class="icon">
                        <i class="fa fa-calendar-check"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box {{ $colors[array_rand($colors)] }}">
                <div class="inner">
                    <a href="/perbarui-password" style="text-decoration: none; color: currentColor;">
                        <h3>Perbarui</h3>
                        <p>Password</p>
                    </a>
                </div><a href="/perbarui-password" style="text-decoration: none; color: currentColor;">
                    <div class="icon">
                        <i class="fa fa-key"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="small-box {{ $colors[array_rand($colors)] }}">
                <div class="inner">
                    <a href="{{ route('admin.user.create') }}" style="text-decoration: none; color: currentColor;">
                        <h3>Akun</h3>
                        <p>Admin</p>
                    </a>
                </div><a href="{{ route('admin.user.create') }}" style="text-decoration: none; color: currentColor;">
                    <div class="icon">
                        <i class="fa fa-user-cog"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-navy">
                    Gelombang
                    <select name="nomor" id="nomor" class="nomor">
                        <option value="">pilih </option>
                        <option {{ $gelombang_selected->nomor == '1' ? 'selected' : '' }}>1</option>
                        <option {{ $gelombang_selected->nomor == '2' ? 'selected' : '' }}>2</option>
                        <option {{ $gelombang_selected->nomor == '3' ? 'selected' : '' }}>3</option>
                    </select>
                    <select name="ta" id="ta" class="ta">
                        <option value="">pilih </option>
                        @foreach ($tahuns as $tahun)
                            <option {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                {{ $tahun->tahun_akademik }}</option>
                        @endforeach
                    </select>
                    <button id="filter" class="btn btn-sm bg-primary"><i class="fa fa-search"></i></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="tampilJk">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="tampilJurusan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/chart.js/Chart.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('template_lte/plugins/chart.js/Chart.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            tampilJk();
            tampilJurusan();
        });

        $('#filter').click(function(e) {
            e.preventDefault();
            tampilJk();
            tampilJurusan();

        });

        function tampilJk() {

            var nomor = $('#nomor').val();
            var ta = $('#ta').val();

            $.ajax({
                type: "get",
                url: "/admin/dashboard/grafikJk",
                data: {
                    nomor: nomor,
                    ta: ta
                },
                dataType: "json",
                beforeSend: function() {
                    $("#tampilJk").html('<i class="fa fa-spinner fa-spin"></i> Sedang memuat...');
                },
                success: function(response) {
                    $("#tampilJk").html(response.view);
                    renderPieChart();
                }
            });
        }

        function tampilJurusan() {

            var nomor = $('#nomor').val();
            var ta = $('#ta').val();

            $.ajax({
                type: "get",
                url: "/admin/dashboard/grafikJurusan",
                data: {
                    nomor: nomor,
                    ta: ta
                },
                dataType: "json",
                beforeSend: function() {
                    $("#tampilJurusan").html(
                        '<i class="fa fa-spinner fa-spin"></i> Sedang memuat data per Jurusan...');
                },
                success: function(response) {
                    $("#tampilJurusan").html(response.view);
                    renderJurusanChart();
                }
            });
        }
    </script>

    <script>
        function generateRandomColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                const r = Math.floor(Math.random() * 255);
                const g = Math.floor(Math.random() * 255);
                const b = Math.floor(Math.random() * 255);
                colors.push(`rgba(${r}, ${g}, ${b}, 0.6)`); // 0.6 biar agak transparan
            }
            return colors;
        }
        // render chart
        let pieChart;
        let barChart;

        function renderPieChart() {
            const labelsInput = document.getElementById('labelsData');
            const jumlahInput = document.getElementById('jumlahData');
            const canvasJk = document.getElementById('chartjk');

            if (!labelsInput || !jumlahInput || !canvasJk) return;

            const labels = JSON.parse(labelsInput.value);
            const data = JSON.parse(jumlahInput.value);
            const chartnya = canvasJk.getContext('2d');

            if (pieChart) pieChart.destroy();

            pieChart = new Chart(chartnya, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: generateRandomColors(data.length),
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Distribusi Jenis Kelamin Mahasiswa'
                        }
                    }
                }
            });
        }

        function renderJurusanChart() {
            const labelsInputJurusan = document.getElementById('labelsJurusanData');
            const jumlahInputJurusan = document.getElementById('jumlahJurusanData');
            const canvasInputJurusan = document.getElementById('chartJurusan');

            if (!labelsInputJurusan || !jumlahInputJurusan || !canvasInputJurusan) return;

            const labelsJurusan = JSON.parse(labelsInputJurusan.value);
            const dataJurusan = JSON.parse(jumlahInputJurusan.value);
            const chartJurusan = canvasInputJurusan.getContext('2d');

            // cari nilai maksimum dari data
            var maxData = Math.max(...dataJurusan);

            // biar ada ruang kosong di atas bar, naikkan sedikit, misalnya dibulatkan ke atas ke kelipatan 5
            var yMax = Math.ceil((maxData + 1) / 5) * 5;
            if (barChart) barChart.destroy();

            barChart = new Chart(chartJurusan, {
                type: 'bar',
                indexAxis: 'y',
                data: {
                    labels: labelsJurusan,
                    datasets: [{
                        label: 'Jumlah Mahasiswa',
                        data: dataJurusan,
                        backgroundColor: generateRandomColors(dataJurusan.length),
                        borderColor: generateRandomColors(dataJurusan.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                min: 0, // ⬅ tambahkan ini untuk pastikan mulai dari 0
                                // max: 5, // opsional kalau mau paksa batas atas
                                max: yMax,
                                // stepSize: 1 // opsional: supaya jaraknya enak
                            }
                        }]
                    }
                },
                plugins: {
                    legend: {
                        display: false // <- Hapus legend dari chart
                    },
                }
            });
        }
        // end renderchart
    </script>
@endpush
