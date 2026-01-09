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
                Laporan Kegiatan BBQ
            </h3>

        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-sm" id="data-table">
                    <thead class="bg-gradient-success">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Kelompok</th>
                            <th>Pertemuan</th>
                            <th>Statistik</th>
                            <th>Materi & Catatan</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <!-- NO -->
                                <th class="text-center">{{ $loop->iteration }}</th>

                                <!-- KELOMPOK -->
                                <td>
                                    <div class="font-weight-bold text-primary">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        {{ $laporan->jadwal->tutor->name }}
                                    </div>
                                    <div class="text-muted small">
                                        <i class="far fa-clock"></i>
                                        {{ $laporan->jadwal->waktu->hari }},
                                        {{ $laporan->jadwal->waktu->jam }}
                                    </div>
                                </td>

                                <!-- PERTEMUAN + TANGGAL -->
                                <td>
                                    <span class="badge badge-info d-inline-block mb-1">
                                        Ke-{{ $laporan->no_pertemuan }}
                                    </span>
                                    <div class="text-muted small">
                                        <i class="far fa-calendar"></i>
                                        {{ indoDateFull($laporan->tanggal) }}
                                    </div>
                                </td>

                                <!-- STATISTIK -->
                                <td>
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-users"></i> {{ $laporan->jumlah_peserta }}
                                    </span>
                                    <span class="badge badge-success">
                                        H {{ $laporan->hadir }}
                                    </span>
                                    <span class="badge badge-warning">
                                        I {{ $laporan->izin }}
                                    </span>
                                    <span class="badge badge-danger">
                                        A {{ $laporan->absen }}
                                    </span>
                                </td>

                                <!-- MATERI & KETERANGAN -->
                                <td style="max-width: 220px;">
                                    <div class="font-weight-bold">
                                        {{ $laporan->materi }}
                                    </div>
                                    <div class="text-muted small text-wrap">
                                        {{ $laporan->keterangan ?: '-' }}
                                    </div>
                                </td>

                                <!-- FOTO -->
                                <td class="text-center">
                                    @if ($laporan->foto)
                                        <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank"
                                            class="btn btn-xs btn-warning" title="Lihat Foto">
                                            <i class="fa fa-image"></i>
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <!-- AKSI -->
                                <td class="text-center">
                                    <form action="{{ route('tutor.laporan.destroy', $laporan->id) }}" method="POST"
                                        class="d-inline form-delete">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs btn-delete-laporan"
                                            title="Hapus Laporan">
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
