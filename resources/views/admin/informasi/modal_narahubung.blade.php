<div class="modal fade" id="modal-cp1" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-lg">

            <!-- Header -->
            <div class="modal-header bg-gradient-cyan py-2">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-headset mr-2"></i> Narahubung BBQ
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.informasi.narahubung', $informasi->id) }}">
                @method('put')
                @csrf

                <div class="modal-body px-4 py-3">

                    <div class="row">

                        <!-- Ikhwan -->
                        <div class="col-md-6">
                            <div class="card border-info shadow-sm h-100">
                                <div class="card-header bg-light font-weight-bold text-info text-center py-1">
                                    <i class="fas fa-male mr-1"></i> Ikhwan
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="small font-weight-bold">Nama Narahubung</label>
                                        <input type="text" name="nama_cp1" class="form-control"
                                            value="{{ $informasi->nama_cp1 }}" placeholder="Nama CP Ikhwan">
                                    </div>

                                    <label class="small font-weight-bold">Nomor WhatsApp</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-success font-weight-bold">+62</span>
                                        </div>
                                        <input type="number" name="cp1" class="form-control" placeholder="8xxxxxxx"
                                            value="{{ $informasi->cp1 }}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Akhwat -->
                        <div class="col-md-6 mt-3 mt-md-0">
                            <div class="card border-pink shadow-sm h-100">
                                <div class="card-header bg-light font-weight-bold text-pink text-center py-1">
                                    <i class="fas fa-female mr-1"></i> Akhwat
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="small font-weight-bold">Nama Narahubung</label>
                                        <input type="text" name="nama_cp2" class="form-control"
                                            value="{{ $informasi->nama_cp2 }}" placeholder="Nama CP Akhwat">
                                    </div>

                                    <label class="small font-weight-bold">Nomor WhatsApp</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-success font-weight-bold">+62</span>
                                        </div>
                                        <input type="number" name="cp2" class="form-control" placeholder="8xxxxxxx"
                                            value="{{ $informasi->cp2 }}">
                                    </div>

                                </div>
                            </div>
                        </div>

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
