@extends('template.main')

@section('content-header')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="" class="row">
                    @csrf
                    <span class="mt-1">Gelombang</span>
                    <div class="col-sm-3">
                        <select name="nomor" id="nomor" class="form-control">
                            <option value="">pilih </option>
                            <option {{ $informasi->gelombang->nomor == '1' ? 'selected' : '' }}>1</option>
                            <option {{ $informasi->gelombang->nomor == '2' ? 'selected' : '' }}>2</option>
                            <option {{ $informasi->gelombang->nomor == '3' ? 'selected' : '' }}>3</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="ta" id="ta" class="form-control">
                            <option value="">pilih </option>
                            @foreach ($tahuns as $tahun)
                                <option
                                    {{ $informasi->gelombang->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                    {{ $tahun->tahun_akademik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm3">
                        <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> filter</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-sm table-striped " id="example1">
                        <thead>
                            <tr class="bg-maroon">
                                <th scope="col">#</th>
                                <th class="th-sm">Nama Lengkap</th>
                                <th class="th-sm">Kelas</th>
                                <th class="th-sm">Jenis Kelamin</th>
                                <th>Gelombang</th>
                                <th class="th-sm">Jadwal BBQ</th>
                                <th class="th-sm">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="d-block font-weight-bold">
                                            {{ $mahasiswa->nama }}
                                        </span>
                                        <span class="d-block text-muted small">
                                            NPM: {{ $mahasiswa->npm }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-block font-weight-semibold">
                                            {{ $mahasiswa->jurusan->kode . ' - ' . $mahasiswa->kelas->nama }}
                                        </span>
                                        <span class="d-block text-muted small">
                                            Kelancaran: {{ $mahasiswa->kelancaran_mengaji }}
                                        </span>
                                    <td>{{ ucwords($mahasiswa->jk) }}
                                    <td>
                                        {{ $mahasiswa->gelombang->tahun_akademik . '-' . $mahasiswa->gelombang->nomor }}
                                    </td>
                                    <td>
                                        <span class="d-block fw-semibold">
                                            Tutor:
                                            {{ $mahasiswa->kelompok->jadwal->tutor->name ?? '' }}
                                        </span>
                                        <span class="d-block text-success font-wight-bold small">
                                            {{ $mahasiswa->kelompok->jadwal->waktu->hari ?? '' }}:
                                            {{ $mahasiswa->kelompok->jadwal->waktu->jam ?? '' }}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $nilai = $mahasiswa->kelompok->nilai_akhir ?? null;
                                            $huruf = $mahasiswa->kelompok->huruf_mutu ?? null;

                                            $badgeClass = match ($huruf) {
                                                'A' => 'badge-success',
                                                'B' => 'badge-primary',
                                                'E' => 'badge-danger',
                                                default => 'badge-secondary',
                                            };
                                        @endphp

                                        @if ($huruf)
                                            <div class="d-inline-block text-center">
                                                <span class="badge badge-sm {{ $badgeClass }} px-2 py-1"
                                                    style="font-size:1.0rem; letter-spacing:1px;">
                                                    {{ $huruf }}
                                                </span>
                                                @if ($nilai)
                                                    <div class="text-muted text-sm mt-1">
                                                        {{ $nilai }}
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal keterangan --}}
    <div class="modal fade" tabindex="1" id="modal-keterangans">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-blue">
                    <h4 class="modal-title  text-center" id="judul-modal-keterangan"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="update-keterangan">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <select name="keterangan" id="keterangan" class="form-control">
                                <option value="lunas">Lunas</option>
                                <option value="belum">Belum Lunas
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- modal password --}}
    <div class="modal fade" tabindex="1" id="modal-passwords">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content ">
                <div class="modal-header bg-gradient-blue">
                    <h4 class="modal-title  text-center" id="judul-modal-password"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="update-password">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('#example1').DataTable()

        })

        $('.btn-keterangan').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var keterangan = $(this).data('keterangan');
            var url = $(this).data('url');

            $('#mahasiswa_id').val(id);
            $('#keterangan').val(keterangan);
            $('#judul-modal-keterangan').text("Edit Keterangan: " + nama);
            $('#update-keterangan').attr('action', url);
            // Buka modal
            $('#modal-keterangans').modal('show');
        });

        $('.btn-jadwal').click(function(e) {
            e.preventDefault();
            var jadwal_kuliah = $(this).data('jadwal');
            var url = $(this).data('url');

            window.open(url, '_blank');

        });

        $('.btn-password').click(function(e) {
            e.preventDefault();
            var npm = $(this).data('npm');
            var nama = $(this).data('nama');
            // var password = $(this).data('password');
            var url = $(this).data('url');

            $('#password').val(npm);
            $('#judul-modal-password').text("Edit password: " + nama);
            $('#update-password').attr('action', url);
            // Buka modal
            $('#modal-passwords').modal('show');
        });

        $('.btn-delete-user').click(function(e) {
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
            });
        });
    </script>

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
    @if (session('toast_icon'))
        <script>
            Toast.fire({
                icon: "{{ session('toast_icon') }}",
                title: "{{ session('toast_title') }}",
            });
        </script>
    @endif
@endpush
