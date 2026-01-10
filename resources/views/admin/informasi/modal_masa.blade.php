<div class="modal fade" id="modal-masa" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-lg">

            <!-- HEADER -->
            <div class="modal-header bg-gradient-teal py-2">
                <h5 class="modal-title text-white">
                    <i class="fas fa-stream mr-2"></i> Timeline Pendaftaran
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.informasi.masa', $informasi->id) }}">
                @method('put')
                @csrf

                <!-- BODY -->
                <div class="modal-body px-4 py-3">

                    <!-- Gelombang -->
                    <div class="form-group">
                        <label class="font-weight-bold">Gelombang Pendaftaran</label>
                        <select name="nomor" class="form-control">
                            <option value="1" {{ $informasi->gelombang->nomor == '1' ? 'selected' : '' }}>Gelombang
                                1</option>
                            <option value="2" {{ $informasi->gelombang->nomor == '2' ? 'selected' : '' }}>Gelombang
                                2</option>
                            <option value="3" {{ $informasi->gelombang->nomor == '3' ? 'selected' : '' }}>Gelombang
                                3</option>
                        </select>
                    </div>

                    <!-- Tahun Ajar -->
                    <div class="form-group">
                        <label class="font-weight-bold">Tahun Akademik</label>
                        <select name="tahun_akademik" class="form-control select2bs4">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($tahuns as $tahun)
                                <option value="{{ $tahun->tahun_akademik }}"
                                    {{ $tahun->tahun_akademik == $informasi->gelombang->tahun_akademik ? 'selected' : '' }}>
                                    {{ $tahun->tahun_akademik }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Masa Pendaftaran -->
                    @php
                        use Carbon\Carbon;
                        $mulai_daftar = Carbon::parse($informasi->mulai_daftar)->format('d/m/Y');
                        $akhir_daftar = Carbon::parse($informasi->akhir_daftar)->format('d/m/Y');
                    @endphp

                    <div class="form-group">
                        <label class="font-weight-bold">Masa Pendaftaran</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white">
                                    <i class="far fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="masa_daftar" id="masa_daftar"
                                value="{{ $mulai_daftar }} - {{ $akhir_daftar }}">
                        </div>
                        <small class="text-muted mt-1 d-block">
                            Tentukan rentang waktu dibukanya pendaftaran
                        </small>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-info btn-sm px-4 shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
