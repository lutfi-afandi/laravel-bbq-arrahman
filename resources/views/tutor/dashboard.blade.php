@extends('template.main')
@section('content-header')
    <form action="" class="row">
        @csrf
        <span class="mt-1 ml-2">Gelombang</span>
        <div class="col-sm-1 mb-1">
            <select name="nomor" id="nomor" class="form-control">
                <option value="">pilih </option>
                <option {{ $gelombang_selected->nomor == '1' ? 'selected' : '' }}>1</option>
                <option {{ $gelombang_selected->nomor == '2' ? 'selected' : '' }}>2</option>
                <option {{ $gelombang_selected->nomor == '3' ? 'selected' : '' }}>3</option>
            </select>
        </div>
        <div class="col-sm-3 mb-1">
            <select name="ta" id="ta" class="form-control">
                <option value="">pilih </option>
                @foreach ($tahuns as $tahun)
                    <option {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                        {{ $tahun->tahun_akademik }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> filter</button>
        </div>

    </form>
@endsection
@section('content')
    <!-- Default box -->

    <div class="callout callout-info info-box p-3 pl-3">
        <i class="fa fa-calendar-alt fa-4x text-primary"></i>
        <div class="info-box-content ">
            <h3 class="info-box-number mb-0">Jadwal BBQ</h3>
            <h4 class="info-box-text ">Gelombang : {{ $gelombang_selected->nomor }} -
                {{ $gelombang_selected->tahun_akademik }}</h4>
        </div>
    </div>

    <div class="row">
        @if ($kelompoks->isEmpty())
            <div class="col-md-12">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container text-danger">
                        <h1 class="display-4"><i class="fas fa-exclamation-triangle"></i> Afwan</h1>
                        <p class="lead">Antum belum diberikan kelompok BBQ di semester ini. </p>
                        <p>Mohon tunggu informasi selanjutnya.</p>
                    </div>
                </div>
            </div>
        @else
            @php
                $colors = [
                    'bg-primary',
                    'bg-success',
                    'bg-info',
                    'bg-warning',
                    'bg-danger',
                    'bg-secondary',
                    'bg-light',
                    'bg-dark',
                    'bg-navy',
                    'bg-indigo',
                    'bg-purple',
                    'bg-pink',
                    'bg-orange',
                    'bg-teal',
                    'bg-olive',
                ];
            @endphp
            @foreach ($kelompoks as $jadwal)
                @php
                    // Ambil warna secara acak
                    $randomColor = $colors[array_rand($colors)];
                @endphp
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box {{ $randomColor }}">
                        <div class="inner">
                            <h3>{{ $jadwal->waktu->hari }}</h3>
                            <p>{{ $jadwal->waktu->jam }}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users-cog "></i>
                        </div>
                        <a href="{{ route('tutor.jadwal.show', $jadwal->id) }}" class="small-box-footer">Kelola
                            Kelompok <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

    <!-- /.card -->
@endsection
