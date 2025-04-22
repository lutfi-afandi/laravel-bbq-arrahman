@extends('template.main')

@section('content-header')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bg-gradient-success">
                <h4 class="card-title">Tambah Kelompok</h4>
            </div>
            <div class="card-body bg-success">
                <form action="{{ route('admin.jadwal.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-center" for="pilihGelombang">Gelombang</label>
                                <input type="hidden" name="gelombang_id" value="{{ $informasi->gelombang_id }}">
                                <select class="custom-select " name="gelombang1" id="pilihGelombang" disabled>
                                    <option value="">Gelombang
                                        {{ $informasi->gelombang->nomor }} -
                                        {{ $informasi->gelombang->tahun_akademik }}</option>
                                </select>
                                @error('gelombang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-center" for="tutor_id">Tutor</label>
                                <select class="custom-select select2bs4" name="tutor_id" id="tutor_id" required>
                                    <option value="">Pilih Tutor</option>
                                    @foreach ($tutors as $tutor)
                                        <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
                                    @endforeach
                                </select>
                                @error('gelombang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-center" for="tutor_id">Waktu</label>
                                <select class="custom-select select2bs4" name="waktu_id" id="waktu_id" required>
                                    <option value="">Pilih Waktu</option>
                                    @foreach ($waktus as $waktu)
                                        <option value="{{ $waktu->id }}">{{ $waktu->hari }} - {{ $waktu->jam }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gelombang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <span class="mt-1 ml-2">Gelombang</span>
                        <div class="col-sm-3 mb-1">
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
                                    <option
                                        {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                        {{ $tahun->tahun_akademik }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i>
                            submit
                        </button>


                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-maroon">
            <h4 class="card-title"> Daftar Tutor BBQ <span class="badge bg-navy">Gelombang
                    {{ $gelombang_selected->nomor }} - {{ $gelombang_selected->tahun_akademik }}</span>
            </h4>
        </div>
        <div class="card-body">
            <form action="" class="row">
                @csrf
                <span class="mt-1 ml-2">Gelombang</span>
                <div class="col-sm-3 mb-1">
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
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> filter</button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-warning ml-1">
                        <i class="fa fa-sync-alt text-white"></i>
                    </a>
                </div>
            </form>

            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm text-nowrap" width="100%" id="example1">
                    <thead class="bg-fuchsia">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="10%">Username</th>
                            <th width="35%">Nama Tutor</th>
                            <th width="10%">Jadwal</th>
                            <th>Peserta</th>
                            <th class=" text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jadwal->tutor->username }}</td>
                                <td>{{ $jadwal->tutor->name }}</td>
                                <td>{{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }}</td>
                                <td>
                                    <a href="{{ route('admin.jadwal.show', $jadwal->id) }}"
                                        class="badge bg-success">{{ $jadwal->kelompok->count() ?? '0' }} | peserta
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST"
                                        class="form-delete d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs btn-delete-jadwal"
                                            data-id="{{ $jadwal->id }}">
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
