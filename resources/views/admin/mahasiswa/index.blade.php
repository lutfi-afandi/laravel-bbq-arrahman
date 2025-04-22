@extends('template.main')

@section('content-header')
    <div class="container-fluid">
        <div class="card">
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
                                <option
                                    {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                    {{ $tahun->tahun_akademik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> filter</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-maroon">
            <h4 class="card-title"> Daftar Mahasiswa BBQ <span class="badge bg-navy">Gelombang
                    {{ $gelombang_selected->nomor }} - {{ $gelombang_selected->tahun_akademik }}</span>

            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover text-nowrap" id="example1">
                    <thead>
                        <tr class="bg-maroon">
                            <th scope="col">#</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Gel</th>
                            <th>Nomor WA</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelancaran</th>
                            <th>Dosen</th>
                            <th>Lunas?</th>
                            <th>Kuliah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mahasiswa->npm }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->jurusan->kode . ' - ' . $mahasiswa->kelas->nama }}</td>
                                <td>{{ $mahasiswa->gelombang->nomor }}</td>
                                <td>
                                    <a target="_blank"
                                        href="https://api.whatsapp.com/send?phone=62{{ $mahasiswa->nomor_wa }}&text=_Assalamualaikum_%0A%0ATerimakasih%20telah%20melakukan%20pendaftaran%20BBQ.%0AKami%20dari%20Pengurus%20BBQ%20Teknokrat%20mengingatkan%20kakak%20untuk%20segera%20menyelesaikan%20membayar%20biaya%20pendaftaran%20BBQ%20sebesar%0A*60k*%20(enam%20puluh%20ribu%20rupiah)%20dengan%20cara%3A%0A%0A1.%20COD%20dimasjid%20kampus%20Asmaul%20Yusuf.%20Atau%2C%0A2.%20Transfer%20ke%20nomor%20rekening%20berikut%20*0098%200102%206355%20535*%20a.n%20*Novita%20ulan%20sari*.%0A%0AAtas%20perhatiannya%20kami%20ucapkan%20Terimakasih%20%F0%9F%99%8F%0A%0A%0ATTD%0ATim%20BBQ%20Teknokrat%20">
                                        62{{ $mahasiswa->nomor_wa }}
                                    </a>
                                </td>
                                <td>{{ $mahasiswa->jk }}</td>
                                <td>{{ $mahasiswa->kelancaran_mengaji }}</td>
                                <td>{{ $mahasiswa->dosen->nama }}</td>
                                <td>
                                    @php
                                        if ($mahasiswa->keterangan == 'lunas') {
                                            $bg = 'success';
                                            $icon = 'fa-check';
                                        } else {
                                            $bg = 'danger';
                                            $icon = 'fa-times';
                                        }
                                    @endphp
                                    <button type="button" class="btn btn-{{ $bg }} btn-xs btn-keterangan"
                                        data-toggle="modal" data-target="#modal-keterangan"
                                        data-nama="{{ $mahasiswa->nama }}" data-id="{{ $mahasiswa->id }}"
                                        data-keterangan="{{ $mahasiswa->keterangan }}"
                                        data-url="{{ route('admin.peserta.keterangan', ['id' => $mahasiswa->id]) }}">
                                        <i class="fa {{ $icon }} text-sm"></i>
                                    </button>

                                </td>
                                <td>
                                    @php
                                        $urlPath = asset('storage/' . $mahasiswa->jadwal_kuliah);
                                    @endphp

                                    <a type="button" class="btn-jadwal" data-jadwal="{{ $mahasiswa->jadwal_kuliah }}"
                                        data-url="{{ $urlPath }}">
                                        <i class="fa fa-file-image text-yellow"></i>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs btn-password" data-toggle="modal"
                                        data-target="#modal-password" data-nama="{{ $mahasiswa->nama }}"
                                        data-npm="{{ $mahasiswa->npm }}"
                                        data-url="{{ route('admin.peserta.update', ['pesertum' => $mahasiswa->id]) }}">
                                        <i class="fa fa-user-lock text-sm"></i>
                                    </button>

                                    <form action="{{ route('admin.peserta.destroy', $mahasiswa->id) }}" method="POST"
                                        class="form-delete d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs btn-delete-user"
                                            data-id="{{ $mahasiswa->id }}">
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
