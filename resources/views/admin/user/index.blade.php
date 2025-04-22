@extends('template.main')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-header bg-gradient-navy">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">
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
                                @foreach ($users as $user)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->jenis_kelamin }}</td>
                                        <td>{{ $user->no_wa }}</td>
                                        <td>
                                            <button type="button" class="btn bg-yellow btn-xs btn-password"
                                                data-toggle="modal" data-target="#modal-password"
                                                data-nama="{{ $user->name }}" data-username="{{ $user->username }}"
                                                data-url="{{ route('admin.user.reset', ['user' => $user->id]) }}">
                                                <i class="fa fa-user-lock text-sm "></i>
                                            </button>

                                            <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                                class="btn btn-xs btn-primary">
                                                <i class="fa fa-pen"></i>
                                            </a>

                                            <style>
                                                @keyframes pulse {
                                                    0% {
                                                        transform: scale(1);
                                                        opacity: 1;
                                                    }

                                                    50% {
                                                        transform: scale(1.1);
                                                        opacity: 0.7;
                                                    }

                                                    100% {
                                                        transform: scale(1);
                                                        opacity: 1;
                                                    }
                                                }

                                                .pulse {
                                                    animation: pulse 1.5s infinite;
                                                }
                                            </style>
                                            @if (auth()->user()->username == $user->username)
                                                <i class="fa fa-circle text-success fa-pulse"></i>
                                            @else
                                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                                    class="form-delete d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-xs btn-delete-user"
                                                        data-id="{{ $user->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
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
    </div>

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
        @if (session('toast_icon'))
            <script>
                Toast.fire({
                    icon: "{{ session('toast_icon') }}",
                    title: "{{ session('toast_title') }}",
                });
            </script>
        @endif
    @endif
@endpush
