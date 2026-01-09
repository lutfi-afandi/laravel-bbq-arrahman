@extends('template.main')

@section('content')
    <style>
        /* FIX select kepotong di tabel absensi */
        .table td {
            vertical-align: middle;
        }

        .absen-select {
            min-height: 32px;
            /* ini kunci utama */
            padding: 2px 6px;
            font-size: 13px;
        }
    </style>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h5 class="card-title font-weight-bold">
                Kelompok Tutor : {{ $jadwal->tutor->name }}
            </h5>
            <small class="text-success ml-2">
                {{ $jadwal->waktu->hari }} - {{ $jadwal->waktu->jam }} WIB
            </small>

            <div class="card-tools">
                <a href="{{ route('tutor.nilai.show', $jadwal->id) }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-sort-amount-down"></i> Nilai
                </a>
                <a href="{{ route('tutor.jadwal.show', $jadwal->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm text-nowrap mb-0">
                    <thead class="bg-gradient-purple text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">Mahasiswa</th>
                            <th colspan="12">Pertemuan</th>
                            <th rowspan="2" class="align-middle">Update</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 12; $i++)
                                <th width="55">{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kelompoks as $kelompok)
                            @php $mahasiswa = $kelompok->mahasiswa; @endphp

                            <form action="{{ route('tutor.absen.update', $kelompok->id) }}" method="POST">
                                @csrf
                                @method('put')

                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-muted">
                                            {{ $mahasiswa->nama }}
                                        </div>
                                        <div class="text-sm text-primary">
                                            {{ $mahasiswa->npm }}
                                        </div>
                                    </td>


                                    <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

                                    @for ($i = 1; $i <= 12; $i++)
                                        @php $val = $kelompok->{'p'.$i}; @endphp
                                        <td class="text-center">
                                            <select name="p{{ $i }}"
                                                class="form-control form-control-sm absen-select">
                                                <option value=""></option>
                                                <option value="1" {{ $val === 1 ? 'selected' : '' }}>H</option>
                                                <option value="2" {{ $val === 2 ? 'selected' : '' }}>I</option>
                                                <option value="0" {{ $val === 0 ? 'selected' : '' }}>A</option>
                                            </select>
                                        </td>
                                    @endfor

                                    <td class="text-center text-muted">
                                        {{ $kelompok->updated_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-xs bg-gradient-success">
                                            <i class="fas fa-save"></i>
                                        </button>
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
                title: "{{ session('toast_title') }}"
            });
        </script>
    @endif
@endpush
