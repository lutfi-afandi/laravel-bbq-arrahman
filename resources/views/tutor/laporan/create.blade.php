@extends('template.main')

@section('content')
    <div class="card card-default">
        <div class="card-header bg-navy">
            <h3 class="card-title">
                <i class="fas fa-flag-checkered"></i>
                Laporan Tutor : {{ $tutor->name }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('tutor.laporan.index') }}" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i>
                    kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('tutor.laporan.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="gelombang_id" value="{{ $informasi->gelombang_id }}">

                {{-- JADWAL --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">
                        <i class="far fa-clock text-info"></i> Jadwal
                    </label>
                    <div class="col-sm-4">
                        <select class="form-control @error('jadwal_id') is-invalid @enderror" name="jadwal_id" required>
                            <option value="">- Pilih Jadwal -</option>
                            @foreach ($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">
                                    {{ $jadwal->waktu->hari }}, {{ $jadwal->waktu->jam }}
                                </option>
                            @endforeach
                        </select>
                        @error('jadwal_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- PERTEMUAN & TANGGAL --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">
                        <i class="fas fa-calendar-alt text-primary"></i> Pertemuan
                    </label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('no_pertemuan') is-invalid @enderror"
                            name="no_pertemuan" placeholder="Ke-" required>
                        @error('no_pertemuan')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                            required>
                        @error('tanggal')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr>

                {{-- PESERTA --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">
                        <i class="fas fa-users text-secondary"></i> Peserta
                    </label>

                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                            name="jumlah_peserta" placeholder="Total" required>
                        @error('jumlah_peserta')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('hadir') is-invalid @enderror" name="hadir"
                            placeholder="Hadir" required>
                        @error('hadir')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('izin') is-invalid @enderror" name="izin"
                            placeholder="Izin" required>
                        @error('izin')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('absen') is-invalid @enderror" name="absen"
                            placeholder="Absen" required>
                        @error('absen')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr>

                {{-- MATERI --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">
                        <i class="fas fa-book text-success"></i> Materi
                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('materi') is-invalid @enderror" name="materi"
                            placeholder="Materi yang disampaikan" required>
                        @error('materi')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- KETERANGAN --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">
                        <i class="fas fa-info-circle text-muted"></i> Keterangan
                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                            name="keterangan" placeholder="Catatan tambahan (opsional)">
                        @error('keterangan')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- FOTO --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">
                        <i class="fas fa-camera text-warning"></i> Dokumentasi
                    </label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                            accept=".jpg,.jpeg,.png" required>
                        <small class="text-muted">
                            Format JPG / PNG
                        </small>
                        @error('foto')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr>

                {{-- SUBMIT --}}
                <div class="form-group row">
                    <div class="col-sm-8 offset-sm-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan Laporan
                        </button>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#data-table').DataTable()


        })
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
