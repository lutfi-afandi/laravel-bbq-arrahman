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
                <table class="table table-striped table-sm text-nowrap" width="100%">
                    <thead class="bg-gradient-teal">
                        <tr style="height:100%">
                            <th class="align-middle" rowspan="2">NPM</th>
                            <th class="align-middle" rowspan="2">Nama</th>
                            <th class="align-middle text-center" colspan="8">Nilai</th>
                            <th class="align-middle text-center" rowspan="2">⫤ NA ⫤</th>
                            <th class="align-middle" rowspan="2">Update</th>
                            <th class="align-middle" rowspan="2">Aksi</th>
                        </tr>
                        <tr class="text-center">
                            <th width="80px">Kehadiran</th>
                            <th width="80px">Mutabaah</th>
                            <th width="100px"> ⫤ UTS ⫤</th>
                            <th width="80px">Kegiatan</th>
                            <th width="80px">Wudhu</th>
                            <th width="80px">Sholat</th>
                            <th width="80px">Tilawah</th>
                            <th width="110px">⫤ UAS ⫤</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompoks as $nilai)
                            <form action="{{ route('tutor.nilai.update', $nilai->id) }}" method="post">
                                @method('put')
                                @csrf
                                @php
                                    $mahasiswa = $nilai->mahasiswa;
                                @endphp
                                <tr>
                                    <td>{{ $mahasiswa->npm }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>
                                        <input type="text" name="kehadiran" id="kehadiran" class="form-control"
                                            value="{{ $nilai->kehadiran }}">
                                    </td>
                                    <td>
                                        <input type="text" name="mutabaah" id="mutabaah" class="form-control"
                                            value="{{ $nilai->mutabaah }}">
                                    </td>
                                    <td>
                                        <input type="text" name="uts" id="uts" class="form-control"
                                            value="{{ $nilai->uts }}">
                                    </td>
                                    <td>
                                        <input type="text" name="kegiatan_wajib" id="kegiatan_wajib" class="form-control"
                                            value="{{ $nilai->kegiatan_wajib }}">
                                    </td>
                                    <td>
                                        <input type="text" name="wudhu" id="wudhu" class="form-control"
                                            value="{{ $nilai->wudhu }}">
                                    </td>
                                    <td>
                                        <input type="text" name="sholat" id="sholat" class="form-control"
                                            value="{{ $nilai->sholat }}">
                                    </td>
                                    <td>
                                        <input type="text" name="tilawah" id="tilawah" class="form-control"
                                            value="{{ $nilai->tilawah }}">
                                    </td>
                                    <td>
                                        <input type="text" name="uas_tertulis" id="uas_tertulis" class="form-control"
                                            value="{{ $nilai->uas_tertulis }}">
                                    </td>
                                    <td class="text-center">
                                        <span id="nilai_akhir" class="text-bold">{{ $nilai->nilai_akhir }}
                                            {{ $nilai->huruf_mutu ? '(' . $nilai->huruf_mutu . ')' : '' }}</span>
                                        <input type="hidden" name="nilai_akhir" id="na" class="nilai_akhir_input"
                                            value="{{ $nilai->nilai_akhir }}">
                                        <input type="hidden" name="huruf_mutu" id="na" class="huruf_mutu_input"
                                            value="{{ $nilai->huruf_mutu }}">
                                    </td>
                                    <td>
                                        {{ strTime($nilai->updated_nilai) ?? '' }}
                                        <input type="hidden" name="updated_nilai" id="updated_nilai" class="form-control"
                                            value="{{ $nilai->updated_nilai }}">
                                    </td>
                                    <td>
                                        <button class="btn btn-xs bg-gradient-success" type="submit">simpan</button>
                                    </td>
                                </tr>
                            </form>
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
                }
            }


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
