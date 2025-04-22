@extends('template.main')
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-navy">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.tutor.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> add
                </a>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-sm table-striped  text-nowrap" id="example1">
                    <thead class="">
                        <tr class="bg-maroon">
                            <th width="50px" class="text-center" scope="col">#</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor WA</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tutors as $tutor)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $tutor->username }}</td>
                                <td>{{ $tutor->name }}</td>
                                <td>{{ $tutor->jenis_kelamin }}</td>
                                <td>
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=62{{ $tutor->no_wa }}">
                                        {{ $tutor->no_wa }}
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn bg-yellow btn-xs btn-password" data-toggle="modal"
                                        data-target="#modal-password" data-nama="{{ $tutor->name }}"
                                        data-username="{{ $tutor->username }}"
                                        data-url="{{ route('admin.tutor.reset', ['tutor' => $tutor->id]) }}">
                                        <i class="fa fa-user-lock text-sm "></i>
                                    </button>
                                    <a href="{{ route('admin.tutor.edit', $tutor->id) }}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pen"></i>
                                    </a>

                                    <form action="{{ route('admin.tutor.destroy', $tutor->id) }}" method="POST"
                                        class="form-delete d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-xs btn-delete-user"
                                            data-id="{{ $tutor->id }}">
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
                        <button type="submit" class="btn btn-primary btn-block">Reset</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('#example1').DataTable();

            $('.btn-password').click(function(e) {
                e.preventDefault();
                var username = $(this).data('username');
                var nama = $(this).data('nama');
                // var password = $(this).data('password');
                var url = $(this).data('url');

                $('#password').val(username);
                $('#judul-modal-password').text("Edit password: " + nama);
                $('#update-password').attr('action', url);
                // Buka modal
                $('#modal-passwords').modal('show');
            });

        })

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
