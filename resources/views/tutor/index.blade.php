@extends('template.main')
@section('content')
    <div class="card card-maroon card-outline">
        <div class="card-header">
            <h5 class="card-title">Kelompok Tutor : {{ $jadwal->tutor->name }} </h5> &nbsp; <small
                class="text-success">{{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }} WIB
            </small>
            <div class="card-tools">
                <a href="{{ route('tutor.nilai.show', $jadwal->id) }}" class="btn bg-gradient-teal btn-sm"><i
                        class="fas fa-sort-amount-down"></i> Nilai</a>
                <a href="{{ route('tutor.absen.show', $jadwal->id) }}" class="btn btn-info btn-sm"><i
                        class="fas fa-clipboard"></i> Absen</a>
                <a href="/dashboard" class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm text-nowrap" id="data-table">
                    <thead class="bg-gradient-success">
                        <tr>
                            <th class="text-center">#</th>
                            <th>NPM</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas </th>
                            <th>Nomor WA</th>
                            <th>Kelancaran</th>
                            <th>Lunas</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($kelompoks as $kelompok)
                            <tr class="">
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td class="align-middle">{{ $kelompok->mahasiswa->npm }}</td>
                                <td class="align-middle">{{ $kelompok->mahasiswa->nama }}</td>
                                <td class="align-middle">{{ $kelompok->mahasiswa->jurusan->kode }} -
                                    {{ $kelompok->mahasiswa->kelas->nama }}</td>
                                <td class="align-middle">
                                    <a target="_blank"
                                        href="https://api.whatsapp.com/send?phone=62{{ $kelompok->mahasiswa->nomor_wa }}&amp;text=Assalamu'alaikum, %0ASalam kenal, nama Saya *Reza Ashari*%0AKita satu kelompok BBQ %0AYuk berangkat BBQ 😁"
                                        class="badge badge-success ">
                                        <span class="text"><strong>+62 {{ $kelompok->mahasiswa->nomor_wa }}</strong>
                                        </span>
                                    </a>
                                </td>
                                <td class="align-middle">{{ $kelompok->mahasiswa->kelancaran_mengaji }}</td>
                                <td class="align-middle">
                                    {!! $kelompok->mahasiswa->keterangan == 'lunas'
                                        ? '<i class="fa fa-check-circle text-success"></i>'
                                        : '<i class="fa fa-times-circle text-danger"></i>' !!}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
