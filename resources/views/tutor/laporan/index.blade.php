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
    <div class="card card-default">
        <div class="card-header bg-info">
            <h3 class="card-title">
                <i class="fas fa-flag-checkered"></i>
                Laporan Tutor : {{ $tutor->name }}
            </h3>
            <div class="card-tools">
                <a href="" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> add</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-sm text-nowrap" id="data-table">
                    <thead class="bg-gradient-success">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Hari</th>
                            <th>Pertemuan Ke</th>
                            <th>Tanggal </th>
                            <th>Peserta</th>
                            <th>Hadir</th>
                            <th>Izin</th>
                            <th>Absen</th>
                            <th>Materi</th>
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($laporans as $laporan)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $laporan->jadwal->waktu->hari }} - {{ $laporan->jadwal->waktu->jam }}</td>
                                <td>1</td>
                                <td>Thursday, 13 March 2025</td>
                                <td>13</td>
                                <td>10</td>
                                <td>1</td>
                                <td>2</td>
                                <td>konthjkmkk</td>
                                <td>prak</td>
                                <td>
                                    <a class="btn btn-xs btn-warning" target="_blank"
                                        href="https://bbq.arrahmanteknokrat.or.id/assets/uploads/laporan/LaporanGelombang-3-095112-70.jpg"><i
                                            class=" fa fa-file-image"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-xs" onclick="konfimasi('5')" title="Hapus Data"><i
                                            class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#data-table').DataTable()

        })
    </script>
@endpush
