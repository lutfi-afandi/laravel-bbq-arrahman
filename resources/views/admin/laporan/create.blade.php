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
                @method('post')
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jadwal</label>
                    <div class="col-sm-2">
                        <input type="hidden" name="gelombang_id" value="{{ $informasi->gelombang_id }}">
                        <select class="form-control @error('jadwal_id') is-invalid @enderror" name="jadwal_id"
                            required="">
                            <option value="">-Pilih Jadwal-</option>
                            @foreach ($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">{{ $jadwal->waktu->hari }}, {{ $jadwal->waktu->jam }}
                                </option>
                            @endforeach
                        </select>
                        @error('jadwal_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pertemuan" class="col-sm-2 col-form-label">Pertemuan ke</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control @error('no_pertemuan') is-invalid @enderror"
                            id="pertemuan" name="no_pertemuan" placeholder="pertemuan ke" required="">
                        @error('no_pertemuan')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                            name="tanggal" placeholder="tanggal" required="">
                        @error('tanggal')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                            name="jumlah_peserta" placeholder="jumlah peserta" required="">
                        @error('jumlah_peserta')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hadir</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('hadir') is-invalid @enderror" name="hadir"
                            placeholder="jumlah peserta" required="">
                        @error('hadir')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Izin</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('izin') is-invalid @enderror" name="izin"
                            placeholder="Izin" required="">
                        @error('izin')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanpa Keterangan</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('absen') is-invalid @enderror" name="absen"
                            placeholder="Tanpa Keterangan" required="">
                        @error('absen')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Materi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('materi') is-invalid @enderror" name="materi"
                            placeholder="Materi" required="">
                        @error('materi')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('keterangan_laporan') is-invalid @enderror"
                            name="keterangan_laporan" placeholder="Keterangan">
                        @error('keterangan_laporan')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Dokumentasi</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                            placeholder="Dokumentasi" accept=".png, .jpg, .jpeg" required="">
                        @error('foto')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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
