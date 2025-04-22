@extends('template.main')

@section('content')
    @if ($jadwal == null)
        <div class="col-md-6 ">
            <div class="card card-default">
                <div class="card-header bg-info">
                    <h3 class="card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Informasi
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="callout callout-info">
                        <h5>Mohon Maaf!</h5>

                        <p>Kamu belum mendapat kelompok. Silahkan hubungi panitia BBQ untuk lebih lengkapnya</p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    @else
        <div class="card card-maroon card-outline">
            <div class="card-header">
                <div class="card-header">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <td width="200px" class="">Nama Tutor</td>
                                <td width="10px">:</td>
                                <th>{{ $jadwal->tutor->name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nomor WA</td>
                                <td>:</td>
                                <th>{{ $jadwal->tutor->no_wa }}</th>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>:</td>
                                <th>{{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }} WIB
                                </th>
                            </tr>
                        </tbody>
                    </table>

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
                                <th>Jurusan - Kelas </th>
                                <th>Nomor WA </th>
                                <th>Kelancaran</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($mahasiswas as $row)
                                <tr class="{{ $mahasiswa->id == $row->id ? 'table-success' : '' }}">
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="align-middle">{{ $row->npm }}</td>
                                    <td class="align-middle">{{ $row->nama }}</td>
                                    <td class="align-middle">{{ $row->jurusan->kode }} - {{ $row->kelas->nama }}</td>
                                    <td class="align-middle">
                                        <a target="_blank"
                                            href="https://api.whatsapp.com/send?phone=62{{ $row->nomor_wa }}&amp;text=Assalamu'alaikum, %0ASalam kenal, nama Saya *Reza Ashari*%0AKita satu kelompok BBQ %0AYuk berangkat BBQ 😁"
                                            class="badge badge-success ">
                                            <span class="text"><strong>+62 {{ $row->nomor_wa }}</strong> </span>
                                        </a>
                                    </td>
                                    <td class="align-middle">{{ $row->kelancaran_mengaji }}</td>
                                    <td class="align-middle">{{ ucwords($row->jk) }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="card card-maroon card-outline">
            <div class="card-header">
                <h5 class="card-title">Kehadiran <strong>{{ $mahasiswa->nama }}</strong> </h5> &nbsp; <small
                    class="text-success"></small>
                <div class="card-tools">

                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-sm text-nowrap" width="100%">
                        <thead class="bg-gradient-purple">
                            <tr>
                                <th width="10%" class="text-center align-middle" rowspan="2">NPM</th>
                                <th width="20%" class="text-center align-middle" rowspan="2">Nama</th>
                                <th class="text-center" colspan="12">Pertemuan</th>
                            </tr>
                            <tr class="text-center">
                                <th width="">1</th>
                                <th width="">2</th>
                                <th width="">3</th>
                                <th width="">4</th>
                                <th width="">5</th>
                                <th width="">6</th>
                                <th width="">7</th>
                                <th width="">8</th>
                                <th width="">9<br></th>
                                <th width="">10</th>
                                <th width="">11</th>
                                <th width="">12</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mhs)
                                <tr class="text-center {{ $mahasiswa->id == $mhs->id ? 'table-success' : '' }}">
                                    <td>{{ $mhs->npm }}</td>
                                    <td class="text-left ">{{ $mhs->nama }} </td>
                                    <td>
                                        <i
                                            class="fa {{ icon($mhs->kelompok->p1)['icon'] }} text-{{ icon($mhs->kelompok->p1)['text'] }}"></i>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif
    <!-- /.card -->
@endsection
