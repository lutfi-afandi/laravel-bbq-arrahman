@extends('template.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10">

            <div class="card shadow-sm">
                <div class="card-header bg-gradient-navy d-flex align-items-center">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-layer-group mr-2"></i> {{ $title }}
                    </h3>
                    <div class="card-tools ml-auto">
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalJurusan">
                            <i class="fas fa-plus"></i> Add Jurusan
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="table-jurusan" class="table table-hover text-sm">
                        <thead class="bg-navy text-white">
                            <tr>
                                <th width="50">#</th>
                                <th>Kode</th>
                                <th>Nama Jurusan</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="modalJurusan">
        <div class="modal-dialog">
            <form id="formJurusan">
                <div class="modal-content">
                    <div class="modal-header bg-navy">
                        <h5 class="modal-title">Form Jurusan</h5>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="id">

                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" id="kode" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label>Nama Jurusan</label>
                            <input type="text" id="nama" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" id="save">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let table

        $(function() {
            table = $('#table-jurusan').DataTable({
                ajax: '/admin/jurusan/show',
                processing: true,
                pagingType: "simple",
                lengthChange: true,
                info: false,
                responsive: true,
                language: {
                    lengthMenu: "_MENU_ data",
                    zeroRecords: "Tidak ada data",
                    info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                    infoEmpty: "Data kosong",
                    infoFiltered: "",
                    search: "",
                    searchPlaceholder: "Cari jurusan…",
                    processing: "Memuat...",
                },
                columns: [{
                        data: null,
                        render: (d, t, r, m) => m.row + 1
                    },
                    {
                        data: 'kode',
                        render: d => `<span class="badge badge-info px-2">${d}</span>`
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'id',
                        render: id => `
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-warning" onclick="edit(${id})"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="hapus(${id})"><i class="fas fa-trash"></i></button>
                </div>
            `
                    }
                ]
            })

            $('#formJurusan input').on('input', function() {
                $(this).removeClass('is-invalid')
                $(this).next('.invalid-feedback').html('')
            })
        })

        $('#save').click(function(e) {
            e.preventDefault()

            let id = $('#id').val()
            let url = id ? `/admin/jurusan/${id}` : '/admin/jurusan'
            let type = id ? 'PUT' : 'POST'

            $.ajax({
                url,
                type,
                data: {
                    _token: "{{ csrf_token() }}",
                    kode: $('#kode').val(),
                    nama: $('#nama').val()
                },

                success() {
                    $('#modalJurusan').modal('hide')
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        timer: 1200,
                        showConfirmButton: false
                    })
                    table.ajax.reload()
                    $('#formJurusan')[0].reset()
                    $('#id').val('')
                },

                error(xhr) {
                    let res = xhr.responseJSON
                    $('.form-control').removeClass('is-invalid')
                    $('.invalid-feedback').html('')
                    if (res && res.errors) {
                        $.each(res.errors, function(field, msg) {
                            $('#' + field).addClass('is-invalid')
                            $('#' + field).next('.invalid-feedback').html(msg[0])
                        })
                    }
                }
            })
        })

        function edit(id) {
            $.get(`/admin/jurusan/${id}/edit`, function(d) {
                $('#id').val(d.id)
                $('#kode').val(d.kode)
                $('#nama').val(d.nama)
                $('#modalJurusan').modal('show')
            })
        }

        function hapus(id) {
            Swal.fire({
                title: 'Hapus data?',
                icon: 'warning',
                showCancelButton: true
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: `/admin/jurusan/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus',
                                timer: 1000,
                                showConfirmButton: false
                            })
                            table.ajax.reload()
                        }
                    })
                }
            })
        }
    </script>
@endpush
