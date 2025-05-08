@extends('template.main')
@section('content')
    <div class="card">
        <div class="card-header bg-fuchsia">
            <h4 class="card-title">
                <i class="fa fa-print"></i> Cetak Laporan
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1 mr-0">Gelombang :</div>
                <div class="col-lg-1 mb-1">
                    <select name="nomor" id="nomor" class="form-control">
                        <option value="">pilih </option>
                        <option {{ $gelombang_selected->nomor == '1' ? 'selected' : '' }}>1</option>
                        <option {{ $gelombang_selected->nomor == '2' ? 'selected' : '' }}>2</option>
                        <option {{ $gelombang_selected->nomor == '3' ? 'selected' : '' }}>3</option>
                    </select>
                </div>
                <div class="col-lg-2 mb-1">
                    <select name="ta" id="ta" class="form-control">
                        <option value="">pilih </option>
                        @foreach ($tahuns as $tahun)
                            <option {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                {{ $tahun->tahun_akademik }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-1">
                            <button type="button" class="btn btn-lg py-3 btn-block btn-primary"
                                onclick="export_mahasiswa()">
                                <i class="fa fa-print"></i> Cetak Nilai
                            </button>
                        </div>

                        <div class="col-lg-4 mb-1">
                            <button type="button" class="btn btn-lg py-3 btn-block bg-navy" onclick="export_tutor()">
                                <i class="fa fa-print"></i> Cetak Data Tutor
                            </button>
                        </div>

                        <div class="col-lg-4 mb-1">
                            <button type="button" class="btn btn-lg py-3 btn-block bg-gradient-maroon"
                                onclick="export_kelompok()">
                                <i class="fa fa-print"></i> Cetak Data Kelompok
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function export_mahasiswa() {
            var nomor = $('#nomor').val();
            var ta = $('#ta').val();

            window.location.href = "/admin/exportMahasiswa?nomor=" + nomor + "&ta=" + ta;
        }

        function export_tutor() {
            var nomor = $('#nomor').val();
            var ta = $('#ta').val();

            window.location.href = "/admin/exportTutor?nomor=" + nomor + "&ta=" + ta;
        }

        function export_kelompok() {
            var nomor = $('#nomor').val();
            var ta = $('#ta').val();

            window.location.href = "/admin/exportKelompok?nomor=" + nomor + "&ta=" + ta;
        }
    </script>
@endpush
