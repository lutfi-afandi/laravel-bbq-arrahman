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

                <table class="table table-hover table-sm text-nowrap" id="data-table">
                    <thead class="bg-gradient-success text-white">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Jadwal</th>
                            <th>Pertemuan</th>
                            <th>Peserta</th>
                            <th>Kehadiran</th>
                            <th>Materi & Catatan</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $laporan->jadwal->waktu->hari }}</strong><br>
                                    <small class="text-muted">
                                        <i class="far fa-clock"></i> {{ $laporan->jadwal->waktu->jam }}<br>
                                    </small>
                                </td>

                                <td>
                                    <span class="badge badge-info d-inline-block mb-1">
                                        Ke-{{ $laporan->no_pertemuan }}
                                    </span>
                                    <div class="text-muted small">
                                        <i class="far fa-calendar"></i>
                                        {{ indoDateFull($laporan->tanggal) }}
                                    </div>
                                </td>


                                <td>
                                    <strong>{{ $laporan->jumlah_peserta }}</strong> orang
                                </td>

                                <td>
                                    <span class="badge badge-success">
                                        <i class="fas fa-user-check"></i> {{ $laporan->hadir }}
                                    </span>
                                    <span class="badge badge-warning">
                                        <i class="fas fa-user-clock"></i> {{ $laporan->izin }}
                                    </span>
                                    <span class="badge badge-danger">
                                        <i class="fas fa-user-times"></i> {{ $laporan->absen }}
                                    </span>
                                </td>

                                <td>
                                    <strong>{{ $laporan->materi }}</strong>
                                    @if ($laporan->keterangan)
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-sticky-note"></i>
                                            {{ $laporan->keterangan }}
                                        </small>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($laporan->foto)
                                        <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank"
                                            class="btn btn-xs btn-outline-warning" title="Lihat Foto">
                                            <i class="far fa-image"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <form action="{{ route('tutor.laporan.destroy', $laporan->id) }}" method="POST"
                                        class="form-delete d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-outline-danger btn-delete-laporan"
                                            data-id="{{ $laporan->id }}" title="Hapus Laporan">
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
