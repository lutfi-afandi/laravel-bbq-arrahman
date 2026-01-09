@extends('template.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10 col-md-11">

            <div class="card shadow-sm">
                <div class="card-header bg-gradient-navy d-flex align-items-center">
                    <h3 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-users mr-2"></i> {{ $title }}
                    </h3>
                    <div class="card-tools ml-auto">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm shadow">
                            <i class="fas fa-user-plus"></i> Add User
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-sm table-hover text-nowrap" id="example1">
                            <thead>
                                <tr class="bg-maroon text-white">
                                    <th width="50" class="text-center">#</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th class="text-center">JK</th>
                                    <th>No. WhatsApp</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>

                                        <td>
                                            <span class="font-weight-bold">{{ $user->username }}</span>
                                        </td>

                                        <td>{{ $user->name }}</td>

                                        <td class="text-center">
                                            <span
                                                class="badge {{ $user->jenis_kelamin == 'L' ? 'badge-primary' : 'badge-pink' }}">
                                                {{ $user->jenis_kelamin }}
                                            </span>
                                        </td>

                                        <td>
                                            <i class="fab fa-whatsapp text-success"></i>
                                            {{ $user->no_wa }}
                                        </td>

                                        <td class="text-center">

                                            <button type="button" class="btn btn-warning btn-xs btn-password shadow-sm"
                                                data-toggle="modal" data-target="#modal-password"
                                                data-nama="{{ $user->name }}" data-username="{{ $user->username }}"
                                                data-url="{{ route('admin.user.reset', ['user' => $user->id]) }}">
                                                <i class="fas fa-key"></i>
                                            </button>

                                            <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                                class="btn btn-primary btn-xs shadow-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            @if (auth()->user()->username == $user->username)
                                                <span class="badge badge-success ml-1">
                                                    <i class="fas fa-user-check mr-1"></i> Akun Anda
                                                </span>
                                            @else
                                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                                    class="d-inline form-delete">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-xs btn-delete-user shadow-sm"
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

    {{-- Modal Password --}}
    <div class="modal fade" id="modal-passwords" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header bg-gradient-blue">
                    <h5 class="modal-title font-weight-bold" id="judul-modal-password"></h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <form action="" method="post" id="update-password">
                        @method('put')
                        @csrf

                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="text" class="form-control" name="password" id="password">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block shadow-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Reset Password
                        </button>

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
