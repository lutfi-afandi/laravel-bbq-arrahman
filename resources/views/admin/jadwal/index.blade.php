@extends('template.main')

@section('content-header')
    <div class="container-fluid">


    </div>
@endsection
@section('content')
    <div class="row">

        {{-- PANEL INPUT --}}
        <div class="col-lg-4 col-md-5">
            <div class="card card-outline card-success shadow">

                <div class="card-header bg-success">
                    <h4 class="card-title">
                        <i class="fas fa-layer-group mr-1 text-white"></i>
                        Form Tambah Kelompok
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.jadwal.store') }}" method="post">
                        @csrf

                        <div class="row">

                            {{-- Gelombang --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-flag mr-1 text-muted"></i> Gelombang
                                    </label>
                                    <input type="hidden" name="gelombang_id" value="{{ $informasi->gelombang_id }}">
                                    <select class="custom-select" disabled>
                                        <option>
                                            Gelombang {{ $informasi->gelombang->nomor }} —
                                            {{ $informasi->gelombang->tahun_akademik }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- Waktu --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        <i class="far fa-clock mr-1 text-muted"></i> Waktu
                                    </label>
                                    <select class="custom-select select2bs4" name="waktu_id" required style="width:100%">
                                        <option value="" hidden>— Pilih Waktu —</option>
                                        @foreach ($waktusGrouped as $hari => $items)
                                            <optgroup label="{{ $hari }}">
                                                @foreach ($items as $waktu)
                                                    <option value="{{ $waktu->id }}">
                                                        {{ $hari }} — {{ $waktu->jam }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Tutor --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-tie mr-1 text-muted"></i> Tutor
                                    </label>
                                    <select class="custom-select select2bs4" name="tutor_id" required style="width:100%">
                                        <option value="" hidden>— Pilih Tutor —</option>
                                        @foreach ($tutors as $tutor)
                                            <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Nomor & Tahun --}}
                            <div class="col-5">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-hashtag mr-1 text-muted"></i> Gelombang
                                    </label>
                                    <select name="nomor" class="form-control">
                                        <option value="">Pilih</option>
                                        <option {{ $gelombang_selected->nomor == '1' ? 'selected' : '' }}>1</option>
                                        <option {{ $gelombang_selected->nomor == '2' ? 'selected' : '' }}>2</option>
                                        <option {{ $gelombang_selected->nomor == '3' ? 'selected' : '' }}>3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-calendar-alt mr-1 text-muted"></i> Tahun Akademik
                                    </label>
                                    <select name="ta" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($tahuns as $tahun)
                                            <option
                                                {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                                {{ $tahun->tahun_akademik }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-success btn-block btn-lg shadow-sm">
                                    <i class="fas fa-save mr-1"></i> Simpan Kelompok
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>


        {{-- PANEL DATA --}}
        <div class="col-lg-8 col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-maroon">
                    <h4 class="card-title">
                        Daftar Tutor BBQ
                        <span class="badge badge-light ml-2">
                            Gelombang {{ $gelombang_selected->nomor }} - {{ $gelombang_selected->tahun_akademik }}
                        </span>
                    </h4>
                </div>

                <div class="card-body">

                    <form class="form-inline mb-3">
                        <label class="mr-2">Filter Gelombang:</label>

                        <select name="nomor" class="form-control mr-2">
                            <option value="" hidden>-pilih gelombang-</option>
                            <option {{ $gelombang_selected->nomor == '1' ? 'selected' : '' }}>1</option>
                            <option {{ $gelombang_selected->nomor == '2' ? 'selected' : '' }}>2</option>
                            <option {{ $gelombang_selected->nomor == '3' ? 'selected' : '' }}>3</option>
                        </select>

                        <select name="ta" class="form-control mr-2">
                            <option value="">Tahun</option>
                            @foreach ($tahuns as $tahun)
                                <option
                                    {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                    {{ $tahun->tahun_akademik }}
                                </option>
                            @endforeach
                        </select>

                        <button class="btn btn-info mr-1">
                            <i class="fas fa-filter"></i>
                        </button>

                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-warning">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-sm text-nowrap" id="example1">
                            <thead class="bg-fuchsia">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Tutor</th>
                                    <th>JK</th>
                                    <th>Jadwal</th>
                                    <th>Peserta</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jadwal->tutor->username }}</td>
                                        <td>{{ $jadwal->tutor->name }}</td>
                                        <td>{{ $jadwal->tutor->jenis_kelamin }}</td>
                                        <td>{{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }}</td>
                                        <td>
                                            <a href="{{ route('admin.jadwal.show', $jadwal->id) }}"
                                                class="badge badge-success">
                                                {{ $jadwal->kelompok->count() ?? 0 }} Peserta
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('delete')
                                                <button type="submit" class="btn btn-danger btn-xs btn-delete-jadwal">
                                                    <i class="fas fa-trash"></i>
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
        </div>

    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#example1').DataTable()
        });

        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('.btn-delete-jadwal').click(function(e) {
            e.preventDefault();
            let form = $(this).closest('form'); // Ambil form terkait
            let id = $(this).data('id'); // Ambil ID dari tombol

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Jadwal ini akan dihapus secara permanen!",
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
