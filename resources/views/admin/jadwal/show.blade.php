@extends('template.main')


@section('content')
    <div class="card card-success card-outline">
        <div class="card-header">
            <h4 class="card-title">Kelompok :
                <span class="text-bold">{{ $jadwal->tutor->name }}
                    [{{ $jadwal->waktu->hari . ' - ' . $jadwal->waktu->jam }}]</span>
            </h4>
            <div class="card-tools">
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    kembali</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm text-nowrap" id="data-table">
                    <thead class="bg-gradient-success">
                        <tr>
                            <th class="text-center">#</th>
                            <th>NPM</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan - Kelas </th>
                            <th>Kelancaran</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if ($kelompoks->isEmpty())
                            <tr>
                                <th colspan="7" class="text-center bg-danger">- Belum Ada Data -</th>
                            </tr>
                        @else
                            @foreach ($kelompoks as $kelompok)
                                <tr class="" for="check">
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="align-middle">{{ $kelompok->mahasiswa->npm }}</td>
                                    <td class="align-middle">{{ $kelompok->mahasiswa->nama }}</td>
                                    <td class="align-middle">{{ $kelompok->mahasiswa->jurusan->kode }} -
                                        {{ $kelompok->mahasiswa->kelas->nama }}
                                    </td>
                                    <td class="align-middle">{{ $kelompok->mahasiswa->kelancaran_mengaji }}</td>
                                    <td class="align-middle">{{ $kelompok->mahasiswa->jk }}</td>
                                    <td class="align-middle">

                                        <form action="{{ route('admin.kelompok.destroy', $kelompok->id) }}" method="POST"
                                            class="form-delete d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-xs btn-delete-peserta"
                                                data-id="{{ $kelompok->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h4 class="card-title">Tambah Peserta</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kelompok.store') }}" method="post" id="form-tambah">
                @csrf
                <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                <div class="table-responsive">
                    <table class="table table-striped table-sm text-nowrap" id="example1">
                        <thead class="bg-gradient-warning">
                            <tr>
                                <th class="text-center">#</th>
                                <th>NPM</th>
                                <th>Nama Lengkap</th>
                                <th>Jurusan - Kelas </th>
                                <th>Kelancaran</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody class="">

                            @if ($mahasiswas->isEmpty())
                                <tr>
                                    <th colspan="7" class="text-center bg-danger">- Belum Ada Data -</th>
                                </tr>
                            @else
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr class="" for="check">
                                        <th class="text-center">

                                            <input style="" type="checkbox" id="check" name="mahasiswa_id[]"
                                                value="{{ $mahasiswa->id }}">
                                        </th>
                                        <th class="align-middle">{{ $mahasiswa->npm }}</th>
                                        <td class="align-middle">{{ $mahasiswa->nama }}</td>
                                        <td class="align-middle">{{ $mahasiswa->jurusan->kode }} -
                                            {{ $mahasiswa->kelas->nama }}
                                        </td>
                                        <td class="align-middle">{{ $mahasiswa->kelancaran_mengaji }}</td>
                                        <td class="align-middle">{{ $mahasiswa->jk }}</td>
                                    </tr>
                                @endforeach

                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i>
                                    Submit</button>
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // 
    </script>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
            // Jika baris diklik, otomatis mencentang checkbox
            $("#example1 tbody tr").click(function(e) {
                // Abaikan jika klik pada input checkbox
                if ($(e.target).is("input[type=checkbox]")) return;

                let checkbox = $(this).find("input[type=checkbox]");
                checkbox.prop("checked", !checkbox.prop("checked")); // Toggle checkbox

                // Highlight baris jika checkbox dipilih
                $(this).toggleClass("table-success", checkbox.prop("checked"));
            });

        });

        $('.btn-delete-peserta').click(function(e) {
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
