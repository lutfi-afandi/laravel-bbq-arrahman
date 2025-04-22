@extends('template.main')

@section('content-header')
    <div class="card">
        <div class="card-body">
            <i class="fa fa-sitemap fa-2x text-info"></i>
            <h3 class="d-inline ml-2 font-weight-bolder">{{ $title }}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card card-maroon card-outline ">
                <div class="card-header ">
                    <h3 class="card-title"><strong>PENDAFTARAN</strong></h3>
                    <div class="card-tools mr-2">
                        <a type="button" data-toggle="modal" data-target="#"><i class="fa fa-time"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    <div class=" table-responsive">
                        <table class="table table-striped text-center table-sm text-sm">
                            <thead class="bg-gradient-blue">
                                <tr>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <label
                                            class="badge badge-{{ $informasi->status_pendaftaran == 'dibuka' ? 'success' : 'danger' }}">{{ $informasi->status_pendaftaran }}
                                        </label>
                                    </td>
                                    <td>
                                        @php
                                            if ($informasi->status_pendaftaran == 'dibuka') {
                                                $value = 'ditutup';
                                                $btn = 'danger';
                                                $text = 'tutup';
                                            } else {
                                                $value = 'dibuka';
                                                $btn = 'success';
                                                $text = 'Buka';
                                            }
                                        @endphp
                                        <form action="{{ route('admin.informasi.status', $informasi->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input name="status_pendaftaran" type="hidden" value="{{ $value }}">
                                            <button class="btn btn-xs btn-{{ $btn }}"
                                                type="submit">{{ $text }}</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6 col-lg-8">
            <div class="card card-maroon card-outline ">
                <div class="card-header ">
                    <h3 class="card-title"><strong>INFO PENDAFTARAN</strong></h3>
                    <div class="card-tools mr-2">
                        <a type="button" data-toggle="modal" data-target="#modal-masa"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped text-center table-sm  text-sm">
                                <thead class="bg-gradient-blue">
                                    <tr>
                                        <th>GELOMBANG</th>
                                        <th>TAHUN AJARAN</th>
                                        <th>MASA PENDAFTARAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $informasi->gelombang->nomor }}</td>
                                        <td>{{ $informasi->gelombang->tahun_akademik }}</td>
                                        <td>{{ indoDateFull($informasi->mulai_daftar) }} s.d
                                            {{ indoDateFull($informasi->akhir_daftar) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include('admin.informasi.modal_masa')
                </div>
            </div>
        </div>

        <div class="col-md-8 col-lg-8">
            <div class="card card-maroon card-outline ">
                <div class="card-header ">
                    <h3 class="card-title"><strong>AGENDA</strong></h3>
                    <div class="card-tools mr-2">
                        <a type="button" data-toggle="modal" data-target="#modal-agenda1"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped text-center table-sm  text-sm">
                                <thead class="bg-gradient-blue">
                                    <tr>
                                        <th>LAUNCHING</th>
                                        <th>MULAI KBM</th>
                                        <th>MABIT</th>
                                        <th>JALASAH</th>
                                        <th>TALKSHOW</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ indoDateFull($informasi->launching) }}</td>
                                        <td>{{ indoDateFull($informasi->mulai_kbm) }}</td>
                                        <td>{{ indoDateFull($informasi->mabit) }}</td>
                                        <td>{{ indoDateFull($informasi->jalasah) }}</td>
                                        <td>{{ indoDateFull($informasi->talkshow) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include('admin.informasi.modal_agenda')
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4">
            <div class="card card-maroon card-outline ">
                <div class="card-header ">
                    <h3 class="card-title"><strong>REGISTRASI</strong></h3>
                    <div class="card-tools mr-2">
                        <a type="button" data-toggle="modal" data-target="#modal-biaya1"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center table-sm  text-sm">
                        <thead class="bg-gradient-blue">
                            <tr>
                                <th>BIAYA</th>
                                <th>NOMOR KONFIRMASI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label class="btn btn-primary btn-pill">{{ $informasi->biaya }} K</label>
                                </td>
                                <td>{{ $informasi->wa_konfirmasi }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @include('admin.informasi.modal_biaya')
            </div>
        </div>

        <div class="col-md-4 col-lg-4">
            <div class="card card-maroon card-outline ">
                <div class="card-header ">
                    <h3 class="card-title"><strong>PAMFLET</strong></h3>
                    <div class="card-tools mr-2">
                        <a type="button" data-toggle="modal" data-target="#modal-pamflet1"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <img src="{{ asset('storage/pamflet/' . $informasi->pamflet) }}" class="img img-thumbnail"
                        alt="">
                </div>
                @include('admin.informasi.modal_pamflet')
            </div>
        </div>

        <div class="col-md-8 col-lg-8">
            <div class="card card-maroon card-outline ">
                <div class="card-header ">
                    <h3 class="card-title"><strong>NARAHUBUNG</strong></h3>
                    <div class="card-tools mr-2">
                        <a type="button" data-toggle="modal" data-target="#modal-cp1"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center table-sm text-sm">
                        <thead class="bg-gradient-blue">
                            <tr>
                                <th>NAMA</th>
                                <th>NOMOR WA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>{{ $informasi->nama_cp1 }}</strong> <sub>[IKHWAN]</sub></td>
                                <td>{{ $informasi->cp1 }}</td>
                            </tr>
                            <tr>
                                <td><strong>{{ $informasi->nama_cp2 }}</strong> <sub>[AKHWAT]</sub></td>
                                <td>{{ $informasi->cp2 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @include('admin.informasi.modal_narahubung')
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        $('#modal-masa').on('shown.bs.modal', function() {
            $('#tahun_akademik').select2({
                theme: 'bootstrap4',
                tags: true, // Memungkinkan input data baru
                createTag: function(params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true // Menandakan bahwa ini tag baru
                    };
                },
                dropdownParent: $('#modal-masa')
            });
        });


        // Jika input sudah memiliki nilai, set ulang date range picker
        var tanggal = $('#masa_daftar').val();
        // console.log(tanggal);

        var start = moment(); // Default start date jika tidak ada nilai
        var end = moment(); // Default end date jika tidak ada nilai

        // Jika nilai tidak kosong dan format benar, gunakan sebagai start dan end date
        if (tanggal && tanggal.includes(" - ")) {
            var dates = tanggal.split(" - ");
            start = moment(dates[0], "DD/MM/YYYY");
            end = moment(dates[1], "DD/MM/YYYY");
        }

        $('#masa_daftar').daterangepicker({
            autoUpdateInput: true,
            startDate: start,
            endDate: end,
            locale: {
                format: 'DD/MM/YYYY', // Format sesuai dengan yang diinginkan
                cancelLabel: 'Clear'
            }
        });

        // Event ketika user memilih tanggal
        $('#masa_daftar').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        // Event ketika user menghapus tanggal (Clear)
        $('#masa_daftar').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
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
