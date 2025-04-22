<div class="modal fade" tabindex="1" id="modal-masa">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header p-1 pl-3 pr-3 bg-gradient-teal">
                <h4 class="modal-title  text-center">TIMELINE PENDAFTARAN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form method="post" action="{{ route('admin.informasi.masa', $informasi->id) }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Gelombang</label>
                        <select name="nomor" id="nomor" class="form-control">
                            <option value="1" {{ $informasi->gelombang->nomor == '1' ? 'selected' : '' }}>1
                            </option>
                            <option value="2" {{ $informasi->gelombang->nomor == '2' ? 'selected' : '' }}>2
                            </option>
                            <option value="3" {{ $informasi->gelombang->nomor == '3' ? 'selected' : '' }}>3
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Ajaran</label>
                        <select name="tahun_akademik" id="tahun_akademik" class="form-control select2bs4">
                            <option value="">Pilih Tahun Ajar</option>
                            @foreach ($tahuns as $tahun)
                                <option value="{{ $tahun->tahun_akademik }}"
                                    {{ $tahun->tahun_akademik == $informasi->gelombang->tahun_akademik ? 'selected' : '' }}>
                                    {{ $tahun->tahun_akademik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @php
                            use Carbon\Carbon;
                            $mulai_daftar = Carbon::parse($informasi->mulai_daftar)->format('d/m/Y');
                            $akhir_daftar = Carbon::parse($informasi->akhir_daftar)->format('d/m/Y');
                        @endphp
                        <label for="">Masa Pendaftaran </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" name="masa_daftar" id="masa_daftar"
                                value="{{ $mulai_daftar }} - {{ $akhir_daftar }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info " type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
