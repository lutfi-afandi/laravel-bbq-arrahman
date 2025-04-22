@extends('template.main')
@section('content')
    <div class="card card-success card-outline">
        <div class="card-header">
            <h5 class="card-title font-bold">Kelompok Tutor : {{ $jadwal->tutor->name }} </h5> &nbsp; <small
                class="text-success">{{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }} WIB
            </small>
            <div class="card-tools">
                <a href="{{ route('tutor.nilai.show', $jadwal->id) }}" class="btn bg-gradient-teal btn-sm"><i
                        class="fas fa-sort-amount-down"></i> Nilai</a>
                <a href="{{ route('tutor.jadwal.show', $jadwal->id) }}" class="btn btn-warning btn-sm"><i
                        class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm text-nowrap" width="100%">
                    <thead class="bg-gradient-purple">
                        <tr style="height: 100%">
                            <th class="text-center align-middle" rowspan="2">NPM</th>
                            <th class="align-middle" rowspan="2">Nama</th>
                            <th class="text-center" colspan="12">Pertemuan</th>
                            <th class="text-center align-middle" rowspan="2">update at<br></th>
                            <th class="text-center align-middle" rowspan="2">Aksi<br></th>
                        </tr>
                        <tr class="text-center">
                            <th width="60px">1</th>
                            <th width="60px">2</th>
                            <th width="60px">3</th>
                            <th width="60px">4</th>
                            <th width="60px">5</th>
                            <th width="60px">6</th>
                            <th width="60px">7</th>
                            <th width="60px">8</th>
                            <th width="60px">9<br></th>
                            <th width="60px">10</th>
                            <th width="60px">11</th>
                            <th width="60px">12</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompoks as $kelompok)
                            @php
                                $mahasiswa = $kelompok->mahasiswa;
                            @endphp
                            <form action="{{ route('tutor.absen.update', $kelompok->id) }}" method="post">
                                @method('put')
                                @csrf
                                <tr>
                                    <td class="text-center" width="10%">{{ $mahasiswa->npm }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>
                                        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                        <input type="hidden" name="p2a" value="{{ $kelompok->p3 }}">
                                        <select name="p1" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p1 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p1 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p1 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p2" id="" class="">
                                            @php
                                                echo $kelompok->p2 === null;
                                            @endphp
                                            <option value="" {{ $kelompok->p2 === null ? 'selected' : '' }}></option>
                                            <option value="1" {{ $kelompok->p2 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p2 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p2 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p3" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p3 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p3 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p3 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p4" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p4 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p4 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p4 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p5" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p5 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p5 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p5 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p6" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p6 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p6 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p6 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p7" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p7 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p7 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p7 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p8" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p8 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p8 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p8 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p9" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p9 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p9 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p9 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p10" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p10 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p10 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p10 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p11" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p11 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p11 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p11 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="p12" id="" class="">
                                            <option value=""></option>
                                            <option value="1" {{ $kelompok->p12 === 1 ? 'selected' : '' }}>H</option>
                                            <option value="2" {{ $kelompok->p12 === 2 ? 'selected' : '' }}>I</option>
                                            <option value="0" {{ $kelompok->p12 === 0 ? 'selected' : '' }}>A</option>
                                        </select>
                                    </td>

                                    <td class="text-center" width="10%">
                                        {{ $kelompok->updated_at->format('d-m-Y H:i:s') }}
                                    </td>
                                    <td class="text-center">
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
