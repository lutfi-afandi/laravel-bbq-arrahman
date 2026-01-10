@extends('template.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <div class="card shadow-sm">
                <div class="card-header bg-gradient-navy d-flex align-items-center">
                    <h3 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-user-tie mr-2"></i> {{ $title }}
                    </h3>

                    <div class="card-tools ml-auto">
                        <button class="btn btn-success btn-sm shadow" onclick="tambah()">
                            <i class="fas fa-plus"></i> Add Dosen
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <table class="table table-hover table-striped text-sm">
                        <thead class="bg-gradient-navy text-white">
                            <tr>
                                <th width="50">#</th>
                                <th><i class="fas fa-hashtag mr-1"></i> Kode</th>
                                <th><i class="fas fa-user mr-1"></i> Nama Dosen</th>
                                <th width="140"><i class="fas fa-cogs mr-1"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dosen-table"></tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="modalDosen">
        <div class="modal-dialog">
            <form id="formDosen">
                <div class="modal-content">
                    <div class="modal-header bg-navy">
                        <h5 class="modal-title" id="modalTitle">Form Dosen</h5>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="id">

                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" id="kode" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" id="save">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        loadData()

        function loadData() {
            $.get('/admin/dosen/show', function(data) {
                let html = ''
                data.forEach((d, i) => {
                    html += `
            <tr>
                <td class="text-muted font-weight-bold">${i+1}</td>
                <td><span class="badge badge-info px-2 py-1">${d.kode}</span></td>
                <td class="font-weight-semibold">${d.nama}</td>
                <td>
                    <div class="btn-group btn-group-sm shadow-sm">
                        <button class="btn btn-warning text-white" onclick="edit(${d.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="hapus(${d.id})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>`
                })
                $('#dosen-table').html(html)
            })
        }

        function tambah() {
            $('#modalTitle').text('Tambah Dosen')
            $('#formDosen')[0].reset()
            $('#id').val('')
            $('#modalDosen').modal('show')
        }

        $('#save').click(function(e) {
            e.preventDefault()

            let id = $('#id').val()
            let url = id ? `/admin/dosen/${id}` : '/admin/dosen'
            let type = id ? 'PUT' : 'POST'

            $.ajax({
                url: url,
                type: type,
                data: {
                    _token: "{{ csrf_token() }}",
                    kode: $('#kode').val(),
                    nama: $('#nama').val()
                },
                success: function() {
                    $('#modalDosen').modal('hide')
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Dosen tersimpan',
                        timer: 1500,
                        showConfirmButton: false
                    })
                    loadData()
                },

                error: function(xhr) {
                    let res = xhr.responseJSON
                    $('.form-control').removeClass('is-invalid')
                    $('.invalid-feedback').html('')

                    if (res && res.errors) {
                        $.each(res.errors, function(field, messages) {
                            let input = $('#' + field)
                            input.addClass('is-invalid')
                            input.next('.invalid-feedback').html(messages[0])
                        })
                    }
                }
            })
        })

        function edit(id) {
            $.get(`/admin/dosen/${id}/edit`, function(data) {
                $('#modalTitle').text('Edit Dosen')
                $('#id').val(data.id)
                $('#kode').val(data.kode)
                $('#nama').val(data.nama)
                $('#modalDosen').modal('show')
            })
        }

        function hapus(id) {
            Swal.fire({
                title: 'Hapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: `/admin/dosen/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Dosen Dihapus',
                                timer: 1500,
                                showConfirmButton: false
                            })
                            loadData()
                        }
                    })
                }
            })
        }
    </script>
@endpush
