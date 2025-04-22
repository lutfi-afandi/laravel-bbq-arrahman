@extends('template.main')
@section('content')
    <div class="col-md-6 ">
        <!-- Default box -->
        <div class="card">
            <div class="card-header pb-1 card-footer">
                <h3 class="card-title">Edit User</h3>

                <div class="card-tools">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group  ">
                                <label>Username</label>
                                <input type="text" name="username" disabled
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" required
                                    class="form-control  @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor WA</label>
                                <input type="text" name="no_wa" required
                                    class="form-control  @error('no_wa') is-invalid @enderror"
                                    value="{{ old('no_wa', $user->no_wa) }}">
                                @error('no_wa')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required
                                    class="form-control  @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-Pilih Jenis Kelamin-</option>
                                    <option value="laki-laki"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="perempuan"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
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
