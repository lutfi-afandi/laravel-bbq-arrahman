@extends('template.main')
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-fuchsia text-white">
            <h4 class="card-title mb-0">
                <i class="fa fa-print mr-2"></i> Cetak Laporan
            </h4>
        </div>
        <div class="card-body">
            <style>
                .shadow-modern {
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                }

                .shadow-modern:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
                }

                .btn-primary {
                    background: linear-gradient(135deg, #6f42c1, #a163f7);
                    border: none;
                }

                .btn-info {
                    background: linear-gradient(135deg, #17a2b8, #5bc0de);
                    border: none;
                }

                .btn-danger {
                    background: linear-gradient(135deg, #dc3545, #ff6b6b);
                    border: none;
                }

                .btn i {
                    vertical-align: middle;
                }
            </style>
            <!-- Pilihan Gelombang & Tahun Akademik -->
            <div class="row mb-4 align-items-center">
                <div class="col-auto">
                    <label for="nomor" class="font-weight-bold mb-0">Gelombang:</label>
                </div>
                <div class="col-lg-2 mb-2">
                    <select name="nomor" id="nomor" class="form-control">
                        <option value="">Pilih</option>
                        <option {{ $gelombang_selected->nomor == '1' ? 'selected' : '' }}>1</option>
                        <option {{ $gelombang_selected->nomor == '2' ? 'selected' : '' }}>2</option>
                        <option {{ $gelombang_selected->nomor == '3' ? 'selected' : '' }}>3</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-2">
                    <select name="ta" id="ta" class="form-control">
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach ($tahuns as $tahun)
                            <option {{ $gelombang_selected->tahun_akademik == $tahun->tahun_akademik ? 'selected' : '' }}>
                                {{ $tahun->tahun_akademik }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tombol Cetak -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-lg btn-primary btn-block shadow-modern text-white"
                        onclick="export_mahasiswa()">
                        <i class="fa fa-print fa-lg mr-2"></i> Cetak Nilai
                    </button>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-lg btn-info btn-block shadow-modern text-white"
                        onclick="export_tutor()">
                        <i class="fa fa-print fa-lg mr-2"></i> Cetak Data Tutor
                    </button>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-lg btn-danger btn-block shadow-modern text-white"
                        onclick="export_kelompok()">
                        <i class="fa fa-print fa-lg mr-2"></i> Cetak Data Kelompok
                    </button>
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
