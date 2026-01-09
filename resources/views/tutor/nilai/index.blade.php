@extends('template.main')
@section('content')
    <div class="card card-success card-outline">
        <div class="card-header">
            <h5 class="card-title font-bold">Kelompok Tutor : {{ $jadwal->tutor->name }} </h5> &nbsp; <small
                class="text-success">{{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }} WIB
            </small>
            <div class="card-tools">
                <a href="{{ route('tutor.absen.show', $jadwal->id) }}" class="btn bg-gradient-primary btn-sm"><i
                        class="fas fa-clipboard"></i> Absen</a>
                <a href="{{ route('tutor.jadwal.show', $jadwal->id) }}" class="btn btn-warning btn-sm"><i
                        class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm text-nowrap" width="100%" id="data-table">
                    <thead class="bg-gradient-teal text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">Mahasiswa</th>
                            <th colspan="8">Nilai</th>
                            <th rowspan="2" class="align-middle">⫤ NA ⫤</th>
                            <th rowspan="2" class="align-middle">Update</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <th>Kehadiran</th>
                            <th>Mutabaah</th>
                            <th>UTS</th>
                            <th>Kegiatan</th>
                            <th>Wudhu</th>
                            <th>Sholat</th>
                            <th>Tilawah</th>
                            <th>UAS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kelompoks as $nilai)
                            @php $mhs = $nilai->mahasiswa; @endphp

                            <tr>
                                <!-- MAHASISWA -->
                                <td>
                                    <div class="font-weight-bold text-primary">
                                        {{ $mhs->nama }}
                                    </div>
                                    <div class="text-muted small">
                                        {{ $mhs->npm }}
                                    </div>
                                </td>

                                <form action="{{ route('tutor.nilai.update', $nilai->id) }}" method="post">
                                    @method('put')
                                    @csrf

                                    @foreach (['kehadiran', 'mutabaah', 'uts', 'kegiatan_wajib', 'wudhu', 'sholat', 'tilawah', 'uas_tertulis'] as $field)
                                        <td>
                                            <input type="number" name="{{ $field }}"
                                                class="form-control form-control-sm text-center" min="0"
                                                max="100" value="{{ $nilai->$field }}">
                                        </td>
                                    @endforeach

                                    <!-- NILAI AKHIR -->
                                    <td class="text-center align-middle">
                                        <span id="nilai_akhir" class="font-weight-bold text-info">
                                            {{ $nilai->nilai_akhir }}
                                            {{ $nilai->huruf_mutu ? '(' . $nilai->huruf_mutu . ')' : '' }}
                                        </span>

                                        <input type="hidden" name="nilai_akhir" class="nilai_akhir_input"
                                            value="{{ $nilai->nilai_akhir }}">

                                        <input type="hidden" name="huruf_mutu" class="huruf_mutu_input"
                                            value="{{ $nilai->huruf_mutu }}">
                                    </td>


                                    <!-- UPDATE -->
                                    <td class="align-middle text-muted small">
                                        {{ strTime($nilai->updated_nilai) ?? '-' }}
                                        <input type="hidden" name="updated_nilai" value="{{ now() }}">
                                    </td>

                                    <!-- AKSI -->
                                    <td class="align-middle text-center">
                                        <button type="submit" class="btn btn-xs bg-gradient-success">
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const bobot = {
                kehadiran: 0.15,
                mutabaah: 0.15,
                uts: 0.10,
                kegiatan_wajib: 0.10,
                wudhu: 0.10,
                sholat: 0.10,
                tilawah: 0.15,
                uas_tertulis: 0.15,
            };

            function hitungNilaiAkhir($row) {
                let total = 0;
                let semuaKosong = true;

                $.each(bobot, function(field, weight) {
                    const inputVal = $row.find('input[name="' + field + '"]').val();
                    const nilai = parseFloat(inputVal);

                    if (inputVal !== "" && !isNaN(nilai)) {
                        semuaKosong = false;
                        total += nilai * weight;
                    }
                });

                const $output = $row.find('#nilai_akhir');
                const $hiddenInput = $row.find('.nilai_akhir_input');
                const $hurufMutu = $row.find('.huruf_mutu_input');

                if (semuaKosong) {
                    $output.text('');
                    $hiddenInput.val('');
                    $hurufMutu.val('');
                } else {
                    const nilai_akhir = total.toFixed(2);
                    let grade = '';

                    if (nilai_akhir > 90) {
                        grade = 'A';
                    } else if (nilai_akhir >= 80) {
                        grade = 'B';
                    } else {
                        grade = 'E';
                    }

                    $output.text(nilai_akhir + ' (' + grade + ')');
                    $hiddenInput.val(nilai_akhir);
                    $hurufMutu.val(grade);

                    $output
                        .removeClass('text-success text-warning text-danger')
                        .addClass(
                            grade === 'A' ? 'text-success' :
                            grade === 'B' ? 'text-warning' :
                            'text-danger'
                        )
                        .text(nilai_akhir + ' (' + grade + ')');

                }
            }

            $('table tbody tr').each(function() {
                hitungNilaiAkhir($(this));
            });



            $('table tr').each(function() {
                const $row = $(this);
                $row.find('input').on('input', function() {
                    hitungNilaiAkhir($row);
                });
            });
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
