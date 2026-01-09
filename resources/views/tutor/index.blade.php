@extends('template.main')

@section('content')
    <div class="card card-maroon card-outline">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-0">
                    <i class="fas fa-users mr-1"></i>
                    Kelompok Tutor : {{ $jadwal->tutor->name }}
                </h5>
                <small class="text-success">
                    <i class="far fa-clock"></i>
                    {{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }} WIB
                </small>
            </div>

            <div class="card-tools d-flex ml-auto">
                <a href="{{ route('tutor.nilai.show', $jadwal->id) }}" class="btn bg-gradient-teal btn-sm mr-2">
                    <i class="fas fa-sort-amount-down"></i> Nilai
                </a>
                <a href="{{ route('tutor.absen.show', $jadwal->id) }}" class="btn btn-info btn-sm mr-2">
                    <i class="fas fa-clipboard"></i> Absen
                </a>
                <a href="/dashboard" class="btn btn-warning btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        {{-- BODY --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm" id="data-table">
                    <thead class="bg-gradient-success">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Mahasiswa</th>
                            <th>Kelas</th>
                            <th>WhatsApp</th>
                            <th>Kelancaran</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompoks as $kelompok)
                            <tr>
                                <!-- NO -->
                                <th class="text-center align-middle">
                                    {{ $loop->iteration }}
                                </th>

                                <!-- MAHASISWA -->
                                <td class="align-middle">
                                    <div class="font-weight-bold text-primary">
                                        {{ $kelompok->mahasiswa->nama }}
                                    </div>
                                    <div class="text-muted small">
                                        NPM : {{ $kelompok->mahasiswa->npm }}
                                    </div>
                                </td>

                                <!-- KELAS -->
                                <td class="align-middle">
                                    <span class="badge badge-secondary">
                                        {{ $kelompok->mahasiswa->jurusan->kode }}
                                    </span>
                                    <span class="badge badge-light">
                                        {{ $kelompok->mahasiswa->kelas->nama }}
                                    </span>
                                </td>

                                <!-- WA -->
                                <td class="align-middle">
                                    <a target="_blank"
                                        href="https://api.whatsapp.com/send?phone=62{{ $kelompok->mahasiswa->nomor_wa }}&text=Assalamu'alaikum,%20Salam%20kenal,%20kita%20satu%20kelompok%20BBQ"
                                        class="btn btn-success btn-xs">
                                        <i class="fab fa-whatsapp"></i>
                                        +62 {{ $kelompok->mahasiswa->nomor_wa }}
                                    </a>
                                </td>

                                <!-- KELANCARAN -->
                                <td class="align-middle">
                                    <span class="badge badge-info">
                                        {{ $kelompok->mahasiswa->kelancaran_mengaji }}
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td class="align-middle text-center">
                                    {!! $kelompok->mahasiswa->keterangan == 'lunas'
                                        ? '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Lunas</span>'
                                        : '<span class="badge badge-danger"><i class="fa fa-times-circle"></i> Belum</span>' !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
