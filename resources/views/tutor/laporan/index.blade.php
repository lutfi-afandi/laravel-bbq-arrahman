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
        <div class="card-header bg-navy">
            <h3 class="card-title">
                <i class="fas fa-flag-checkered"></i>
                Laporan Tutor : {{ $tutor->name }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('tutor.laporan.create') }}" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i>
                    add</a>
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
                                <td>{{ $laporan->no_pertemuan }}</td>
                                <td>{{ indoDateFull($laporan->tanggal) }}</td>
                                <td>{{ $laporan->jumlah_peserta }}</td>
                                <td>{{ $laporan->hadir }}</td>
                                <td>{{ $laporan->izin }}</td>
                                <td>{{ $laporan->absen }}</td>
                                <td>{{ $laporan->materi }}</td>
                                <td>{{ $laporan->keterangan }}</td>

                                <td>
                                    <a class="btn btn-xs btn-warning" target="_blank"
                                        href="https://bbq.arrahmanteknokrat.or.id/assets/uploads/laporan/LaporanGelombang-3-095112-70.jpg"><i
                                            class=" fa fa-file-image"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('tutor.laporan.destroy', $laporan->id) }}" method="POST"
                                        class="form-delete d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs btn-delete-laporan"
                                            data-id="{{ $laporan->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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

        $('.btn-delete-laporan').click(function(e) {
            e.preventDefault();
            let form = $(this).closest('form'); // Ambil form terkait
            let id = $(this).data('id'); // Ambil ID dari tombol

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika dikonfirmasi, submit form
                }
            })
        });
    </script>

    @if (session('toast_icon'))
        <script>
            Toast.fire({
                icon: "{{ session('toast_icon') }}",
                title: "{{ session('toast_title') }}",
            });
        </script>
    @endif

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
@endpush
