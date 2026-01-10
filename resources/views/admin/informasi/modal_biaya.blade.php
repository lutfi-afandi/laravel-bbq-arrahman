<div class="modal fade" id="modal-biaya1" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-lg">

            <!-- Header -->
            <div class="modal-header bg-gradient-yellow py-2">
                <h5 class="modal-title font-weight-bold text-dark">
                    <i class="fas fa-receipt mr-2"></i> Registrasi BBQ
                </h5>
                <button type="button" class="close text-dark" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.informasi.biaya', $informasi->id) }}">
                @method('put')
                @csrf

                <div class="modal-body px-4 py-3">

                    <!-- Biaya -->
                    <div class="form-group">
                        <label class="small font-weight-bold">Biaya Registrasi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white font-weight-bold text-success">
                                    Rp
                                </span>
                            </div>
                            <input type="number" name="biaya" class="form-control" value="{{ $informasi->biaya }}"
                                placeholder="Masukkan nominal">
                        </div>
                        <small class="text-muted">Contoh: 150000</small>
                    </div>

                    <!-- WhatsApp -->
                    <div class="form-group mt-3">
                        <label class="small font-weight-bold">Nomor Konfirmasi WhatsApp</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white text-success font-weight-bold">+62</span>
                            </div>
                            <input type="text" name="wa_konfirmasi" class="form-control" placeholder="8xxxxxxxxx"
                                value="{{ $informasi->wa_konfirmasi }}">
                        </div>
                        <small class="text-muted">Gunakan nomor aktif untuk konfirmasi</small>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-info btn-sm px-4 shadow-sm" type="submit">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
