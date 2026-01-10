@extends('template.main')

{{-- ================= HEADER ================= --}}
@section('content-header')
    <div class="row mb-3 align-items-center">
        <div class="col-md-8">
            <div class="bg-transparent rounded px-3 py-2 shadow-none">
                <marquee direction="left" scrollamount="6">
                    <span class="text-muted font-italic">
                        Selamat Datang <strong>{{ auth()->user()->name }}</strong> —
                        Sistem Informasi Bimbingan Belajar Qur'an Teknokrat
                        <span class="text-secondary">(UKMI Ar-Rahman)</span>
                    </span>
                </marquee>
            </div>
        </div>

        <div class="col-md-4">
            {{-- FILTER --}}
            <form action="" class="row align-items-end">
                @csrf
                <div class="col-4">
                    <label class="mb-1 text-sm">Gelombang</label>
                    <select name="nomor" class="form-control form-control-sm">
                        <option value="">Pilih</option>
                        <option {{ $gelombang_selected->nomor == '1' ? 'selected' : '' }}>1</option>
                        <option {{ $gelombang_selected->nomor == '2' ? 'selected' : '' }}>2</option>
                        <option {{ $gelombang_selected->nomor == '3' ? 'selected' : '' }}>3</option>
                    </select>
                </div>
                <div class="col-5">
                    <label class="mb-1 text-sm">Tahun</label>
                    <select name="ta" class="form-control form-control-sm">
                        <option value="">Pilih</option>
                        @foreach ($tahuns as $tahun)
                            <option {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                {{ $tahun->tahun_akademik }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <button class="btn btn-info btn-sm btn-block">
                        <i class="fa fa-filter"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


{{-- ================= CONTENT ================= --}}
@section('content')

    {{-- INFO UTAMA --}}
    <div class="row">
        <div class="col-md-12">
            <div class="info-box bg-light shadow-sm">
                <span class="info-box-icon bg-info">
                    <i class="fa fa-calendar-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jadwal BBQ Aktif</span>
                    <span class="info-box-number">
                        Gelombang {{ $gelombang_selected->nomor }}
                        <small class="text-muted">({{ $gelombang_selected->tahun_akademik }})</small>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- RINGKASAN --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $kelompoks->count() }}</h3>
                    <p>Kelompok Dibimbing</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ auth()->user()->role ?? 'Tutor' }} {{ $tutor->jenis_kelamin }}</h3>
                    <p>{{ $tutor->name }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-check"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ now()->format('d M Y') }}</h3>
                    <p>Tanggal Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}

    <div class="row card mx-1 shadow-none ">

        {{-- JIKA BELUM ADA KELOMPOK --}}
        @if ($kelompoks->isEmpty())
            <div class="col-md-12">
                <div class="callout callout-warning">
                    <h5>
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Belum Ada Kelompok
                    </h5>
                    <p class="mb-1">
                        Antum belum mendapatkan kelompok BBQ pada gelombang ini.
                    </p>
                    <small class="text-muted">
                        Penugasan kelompok dilakukan oleh panitia. Silakan menunggu informasi selanjutnya.
                    </small>
                </div>
            </div>

            {{-- JIKA ADA KELOMPOK --}}
        @else
            @php
                $colors = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-navy'];
            @endphp

            @foreach ($kelompoks as $jadwal)
                @php $randomColor = $colors[array_rand($colors)]; @endphp

                <div class="col-lg-3 col-md-4 col-sm-6 card-body pb-1">
                    <div class="small-box {{ $randomColor }}">
                        <div class="inner">
                            <h4 class="mb-1">{{ $jadwal->waktu->hari }}</h4>
                            <p class="mb-0">{{ $jadwal->waktu->jam }}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users-cog"></i>
                        </div>
                        <a href="{{ route('tutor.jadwal.show', $jadwal->id) }}" class="small-box-footer">
                            Kelola Kelompok <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
