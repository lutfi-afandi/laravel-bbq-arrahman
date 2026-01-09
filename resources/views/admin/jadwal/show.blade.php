@extends('template.main')

@section('content')
    <div class="card card-success card-outline">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                Kelompok Tutor
                <span class="badge badge-success ml-2">
                    {{ $jadwal->tutor->name }}
                </span>
                <span class="badge badge-info ml-1">
                    {{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }}
                </span>
            </h5>
            <div class="card-tools ml-auto mr-1">
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

            </div>
        </div>

        {{-- Anggota kelompok --}}
        <div class="card-body">
            <div class="table-responsive">
                @if ($kelompoks->isEmpty())
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-users-slash fa-3x mb-3"></i><br>
                        <strong>Belum ada peserta di kelompok ini</strong>
                    </div>
                @else
                    <table class="table table-striped table-sm text-nowrap" id="data-table">
                        <thead class="bg-gradient-success">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Mahasiswa</th>
                                <th>Jurusan - Kelas</th>
                                <th>Kelancaran</th>
                                <th>JK</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelompoks as $kelompok)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>

                                    <td>
                                        <strong>{{ $kelompok->mahasiswa->npm }}</strong><br>
                                        <small class="text-muted">{{ $kelompok->mahasiswa->nama }}</small>
                                    </td>

                                    <td>
                                        {{ $kelompok->mahasiswa->jurusan->kode }} -
                                        {{ $kelompok->mahasiswa->kelas->nama }}
                                    </td>

                                    <td>{{ $kelompok->mahasiswa->kelancaran_mengaji }}</td>
                                    <td>{{ ucfirst($kelompok->mahasiswa->jk) }}</td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.kelompok.destroy', $kelompok->id) }}" method="POST"
                                            class="form-delete d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-xs btn-delete-peserta"
                                                data-id="{{ $kelompok->id }}" title="Hapus dari kelompok">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>

    {{-- Belum ada kelompok --}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-user-plus"></i> Tambah Peserta ke Kelompok
            </h5>
        </div>

        <form action="{{ route('admin.kelompok.store') }}" method="post" id="form-tambah">
            @csrf
            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

            <div class="card-body">
                <div class="table-responsive">
                    <@if ($mahasiswas->isEmpty())
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-user-slash fa-3x mb-3"></i><br>
                            <strong>Tidak ada mahasiswa tersedia</strong>
                        </div>
                    @else
                        <table class="table table-striped table-sm text-nowrap" id="example1">
                            <thead class="bg-gradient-warning">
                                <tr>
                                    <th class="text-center">Pilih</th>
                                    <th>Mahasiswa</th>
                                    <th>Jurusan - Kelas</th>
                                    <th>Kelancaran</th>
                                    <th>JK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td class="text-center align-middle">
                                            <input type="checkbox" name="mahasiswa_id[]" value="{{ $mahasiswa->id }}">
                                        </td>

                                        <td>
                                            <strong>{{ $mahasiswa->npm }}</strong><br>
                                            <small class="text-muted">{{ $mahasiswa->nama }}</small>
                                        </td>

                                        <td>
                                            {{ $mahasiswa->jurusan->kode }} -
                                            {{ $mahasiswa->kelas->nama }}
                                        </td>

                                        <td>{{ $mahasiswa->kelancaran_mengaji }}</td>
                                        <td>{{ ucfirst($mahasiswa->jk) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                </div>
            </div>

            @if ($mahasiswas->isNotEmpty())
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-paper-plane"></i> Tambahkan ke Kelompok
                    </button>
                </div>
            @endif
        </form>
    </div>
@endsection


@push('js')
    <script>
        //
    </script>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                // paging: false,
                // searching: false,
                // info: false
            });

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
