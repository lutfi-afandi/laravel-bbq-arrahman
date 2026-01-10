@extends('template.main')

@push('css')
    <style>
        .info-card {
            border-radius: 14px;
            overflow: hidden;
            transition: .25s ease;
        }

        .info-card:hover {
            /* transform: translateY(-3px); */
            box-shadow: 0 10px 22px rgba(0, 0, 0, .1);
        }

        .info-header {
            background: linear-gradient(135deg, #6f042f, #8b0f3f);
            color: #fff;
        }

        .info-header h3 {
            font-size: 1rem;
            letter-spacing: .5px;
        }

        .badge-status {
            padding: .45em .8em;
            border-radius: 20px;
            font-size: .8rem;
            font-weight: 600;
        }

        .btn-xs {
            border-radius: 6px;
            font-weight: 600;
        }

        .table th {
            font-weight: 600;
            letter-spacing: .3px;
        }
    </style>
@endpush

@section('content-header')
    <div class="card shadow-sm">
        <div class="card-body">
            <i class="fa fa-sitemap fa-2x text-info"></i>
            <h3 class="d-inline ml-2 font-weight-bolder">{{ $title }}</h3>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">

        <!-- PENDAFTARAN -->
        <div class="col-md-6 col-lg-4">
            <div class="card info-card">
                <div class="card-header info-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-clipboard-list mr-2"></i> PENDAFTARAN</h3>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-borderless text-center table-sm align-middle">
                            <thead class="bg-gradient-blue text-white">
                                <tr>
                                    <th width="50%">STATUS PENDAFTARAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-light">
                                    <td>
                                        <span
                                            class="badge badge-pill px-3 py-2 shadow-sm
                        badge-{{ $informasi->status_pendaftaran == 'dibuka' ? 'success' : 'danger' }}">
                                            <i
                                                class="fas {{ $informasi->status_pendaftaran == 'dibuka' ? 'fa-door-open' : 'fa-lock' }} mr-1"></i>
                                            {{ strtoupper($informasi->status_pendaftaran) }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            if ($informasi->status_pendaftaran == 'dibuka') {
                                                $value = 'ditutup';
                                                $btn = 'danger';
                                                $text = 'Tutup Pendaftaran';
                                                $icon = 'fa-lock';
                                            } else {
                                                $value = 'dibuka';
                                                $btn = 'success';
                                                $text = 'Buka Pendaftaran';
                                                $icon = 'fa-door-open';
                                            }
                                        @endphp

                                        <form action="{{ route('admin.informasi.status', $informasi->id) }}" method="post"
                                            class="d-inline">
                                            @method('put')
                                            @csrf
                                            <input name="status_pendaftaran" type="hidden" value="{{ $value }}">

                                            <button type="submit"
                                                class="btn btn-sm btn-{{ $btn }} shadow-sm px-3">
                                                <i class="fas {{ $icon }} mr-1"></i> {{ $text }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

        <!-- INFO PENDAFTARAN -->
        <div class="col-md-6 col-lg-8">
            <div class="card info-card">
                <div class="card-header info-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-info-circle mr-2"></i> INFO PENDAFTARAN</h3>
                    <a data-toggle="modal" data-target="#modal-masa" class="text-white  mr-1 ml-auto"><i
                            class="fas fa-edit"></i></a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped text-center table-sm text-sm">
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

                    @include('admin.informasi.modal_masa')

                </div>
            </div>
        </div>

        <!-- AGENDA -->
        <div class="col-md-8 col-lg-8">
            <div class="card info-card">
                <div class="card-header info-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i> AGENDA</h3>
                    <a data-toggle="modal" data-target="#modal-agenda1" class="text-white mr-1 ml-auto "><i
                            class="fas fa-edit"></i></a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped text-center table-sm text-sm">
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

                    @include('admin.informasi.modal_agenda')

                </div>
            </div>
        </div>

        <!-- REGISTRASI -->
        <div class="col-md-4 col-lg-4">
            <div class="card info-card">
                <div class="card-header info-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-file-invoice mr-2"></i> REGISTRASI</h3>
                    <a data-toggle="modal" data-target="#modal-biaya1" class="text-white mr-1 ml-auto"><i
                            class="fas fa-edit"></i></a>
                </div>
                <div class="card-body">

                    <table class="table table-striped text-center table-sm text-sm">
                        <thead class="bg-gradient-blue">
                            <tr>
                                <th>BIAYA</th>
                                <th>NOMOR KONFIRMASI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-primary">{{ $informasi->biaya }} K</span></td>
                                <td>{{ $informasi->wa_konfirmasi }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @include('admin.informasi.modal_biaya')

                </div>
            </div>
        </div>

        <!-- PAMFLET -->
        <div class="col-md-4 col-lg-4">
            <div class="card info-card">
                <div class="card-header info-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-image mr-2"></i> PAMFLET</h3>
                    <a data-toggle="modal" data-target="#modal-pamflet1" class="text-white mr-1 ml-auto"><i
                            class="fas fa-edit"></i></a>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/pamflet/' . $informasi->pamflet) }}" class="img-fluid rounded shadow-sm">
                    @include('admin.informasi.modal_pamflet')
                </div>
            </div>
        </div>

        <!-- NARAHUBUNG -->
        <div class="col-md-8 col-lg-8">
            <div class="card info-card">
                <div class="card-header info-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-phone-alt mr-2"></i> NARAHUBUNG</h3>
                    <a data-toggle="modal" data-target="#modal-cp1" class="text-white mr-1 ml-auto"><i
                            class="fas fa-edit"></i></a>
                </div>
                <div class="card-body">

                    <table class="table table-sm text-center text-sm table-hover">
                        <thead class="bg-gradient-blue">
                            <tr>
                                <th><i class="fas fa-user"></i> NAMA</th>
                                <th><i class="fab fa-whatsapp"></i> NOMOR WA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>{{ $informasi->nama_cp1 }}</strong><br>
                                    <span class="badge badge-info">IKHWAN</span>
                                </td>
                                <td>
                                    <a href="https://wa.me/62{{ ltrim($informasi->cp1, '0') }}" target="_blank"
                                        class="text-success font-weight-bold">
                                        <i class="fab fa-whatsapp"></i> {{ $informasi->cp1 }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{ $informasi->nama_cp2 }}</strong><br>
                                    <span class="badge bg-fuchsia">AKHWAT</span>
                                </td>
                                <td>
                                    <a href="https://wa.me/62{{ ltrim($informasi->cp2, '0') }}" target="_blank"
                                        class="text-success font-weight-bold">
                                        <i class="fab fa-whatsapp"></i> {{ $informasi->cp2 }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    @include('admin.informasi.modal_narahubung')

                </div>
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
