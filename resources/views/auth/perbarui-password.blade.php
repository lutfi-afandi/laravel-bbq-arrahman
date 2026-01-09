@extends('template.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header text-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fa fa-lock mr-1"></i> Perbarui Password
                    </h5>
                </div>

                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fa fa-times-circle mr-1"></i>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fa fa-check-circle mr-1"></i>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('perbaruipassword_new') }}">
                        @csrf

                        {{-- Password Lama --}}
                        <div class="form-group">
                            <label>Password Lama</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control @error('current-password') is-invalid @enderror"
                                    name="current-password" placeholder="Masukkan password lama">
                            </div>
                            @error('current-password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password Baru --}}
                        <div class="form-group">
                            <label>Password Baru</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    name="new_password" placeholder="Masukkan password baru">
                            </div>
                            @error('new_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                </div>
                                <input type="password"
                                    class="form-control @error('new_password_confirm') is-invalid @enderror"
                                    name="new_password_confirm" placeholder="Ulangi password baru">
                            </div>
                            @error('new_password_confirm')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="/" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-save"></i> Perbarui Password
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
