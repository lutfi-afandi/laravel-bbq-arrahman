@extends('template.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-fuchsia">
                    <h4 class="card-title">Daftar Kegiatan</h4>
                    <div class="card-tools">
                        <button type="button" class="btn bg-gradient-yellow btn-sm text-white" data-toggle="modal"
                            data-target="#modal-default">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped" width="100%" id="tabel-kegiatan">
                            <thead class="bg-gradient-fuchsia">
                                <tr>
                                    <th class="text-center" width="3%">No</th>
                                    <th width="15%">Nama Kegiatan</th>
                                    <th width="60%">Deskripsi</th>
                                    <th width="7%">Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $kegiatan)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                                        <td>{{ Str::words($kegiatan->deskripsi, 30, '...') }}</td>
                                        <td>
                                            <img src="{{ asset('storage/kegiatan/' . $kegiatan->foto) }}" alt=""
                                                class="img img-thumbnail kegiatan-img"
                                                style="width: 100px; cursor: pointer;">
                                        </td>

                                        <td>
                                            <form action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}"
                                                method="POST" class="form-delete d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-xs btn-delete-kegiatan"
                                                    data-id="{{ $kegiatan->id }}">
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
        </div>
    </div>

    {{-- modal tambah kegiatan --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.kegiatan.store') }}" method="POST" id="form-kegiatan"
                    enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Kegiatan</label>
                            <input type="hidden" name="id" value="">
                            <input type="text" name="nama_kegiatan" class="form-control" id="nama_kegiatan" required>
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" cols="30" rows="5" class="form-control" id="deskripsi" required></textarea>
                            <label for="">Foto Kegiatan</label>
                            <input type="file" name="foto" class="form-control" id="foto" accept="image/*"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                    </div>
                </form>
                <div class="modal-footer justify-content-between">
                </div>
            </div>
        </div>
    </div>

    {{-- Modal gambar --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: transparent; border: none;">
                <div class="modal-body p-0">
                    <img src="" id="modalImage" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#tabel-kegiatan').DataTable({

                "language": {
                    "lengthMenu": "_MENU_ data", // ganti text "Show X entries"
                    "search": "", // hilangkan label search
                    "searchPlaceholder": "Cari...", // placeholder di input search
                    "zeroRecords": "Tidak ada data yang cocok",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Belum ada data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "›",
                        "previous": "‹"
                    }
                }
            });
        });


        // hapus data
        $('.btn-delete-kegiatan').click(function(e) {
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

        // tampil gambar
        $('.kegiatan-img').on('click', function() {
            var src = $(this).attr('src'); // ambil src dari gambar yang diklik
            $('#modalImage').attr('src', src); // set src ke modal
            $('#imageModal').modal('show'); // tampilkan modal
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
