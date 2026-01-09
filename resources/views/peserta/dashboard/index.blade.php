@extends('template.main')

@section('content')
    @if ($jadwal == null)
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                    <p class="mb-0">
                        Kamu belum mendapat kelompok.
                        Silakan hubungi panitia BBQ untuk informasi lebih lanjut.
                    </p>
                </div>
            </div>
        </div>
    @else
        {{-- ================= INFO TUTOR ================= --}}
        <div class="row">
            <div class="col-md-4">
                <div class="info-box bg-gradient-maroon">
                    <span class="info-box-icon"><i class="fas fa-user-tie"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tutor</span>
                        <span class="info-box-number">{{ $jadwal->tutor->name }}</span>
                        <small>{{ $jadwal->waktu->hari }} • {{ $jadwal->waktu->jam }} WIB</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=62{{ $jadwal->tutor->no_wa }}"
                    class="info-box bg-gradient-success">
                    <span class="info-box-icon"><i class="fab fa-whatsapp"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">WhatsApp Tutor</span>
                        <span class="info-box-number">+62 {{ $jadwal->tutor->no_wa }}</span>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <div class="info-box bg-gradient-info">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Peserta</span>
                        <span class="info-box-number">{{ $mahasiswas->count() }} Orang</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= ANGGOTA KELOMPOK ================= --}}
        <div class="card card-outline card-maroon">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-users"></i> Anggota Kelompok
                </h5>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-sm mb-0">
                        <thead class="bg-gradient-success">
                            <tr>
                                <th class="text-center">#</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Jurusan / Kelas</th>
                                <th>WA</th>
                                <th>Kelancaran</th>
                                <th>JK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $row)
                                <tr class="{{ $mahasiswa->id == $row->id ? 'table-success' : '' }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $row->npm }}</td>
                                    <td class="font-weight-bold">{{ $row->nama }}</td>
                                    <td>{{ $row->jurusan->kode }} - {{ $row->kelas->nama }}</td>
                                    <td>
                                        <a target="_blank"
                                            href="https://api.whatsapp.com/send?phone=62{{ $row->nomor_wa }}"
                                            class="badge badge-success">
                                            <i class="fab fa-whatsapp"></i> +62 {{ $row->nomor_wa }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $row->kelancaran_mengaji }}
                                        </span>
                                    </td>
                                    <td>{{ strtoupper($row->jk) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= KEHADIRAN ================= --}}
        <div class="card card-outline card-maroon">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-check"></i>
                    Kehadiran — <strong>{{ $mahasiswa->nama }}</strong>
                </h5>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-nowrap mb-0">
                        <thead class="bg-gradient-purple text-center">
                            <tr>
                                <th rowspan="2" class="align-middle">NPM</th>
                                <th rowspan="2" class="align-middle">Nama</th>
                                <th colspan="12">Pertemuan</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i <= 12; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mhs)
                                <tr class="text-center {{ $mahasiswa->id == $mhs->id ? 'table-success' : '' }}">
                                    <td>{{ $mhs->npm }}</td>
                                    <td class="text-left">{{ $mhs->nama }}</td>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td>
                                            <i
                                                class="fa
                                        {{ icon($mhs->kelompok->{'p' . $i})['icon'] }}
                                        text-{{ icon($mhs->kelompok->{'p' . $i})['text'] }}">
                                            </i>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
