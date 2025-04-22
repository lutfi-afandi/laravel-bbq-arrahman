<div class="modal fade" tabindex="1" id="modal-biaya1">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header p-1 pl-3 pr-3 bg-gradient-yellow">
                <h4 class="modal-title  text-center">REGISTRASI BBQ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form method="post" action="{{ route('admin.informasi.biaya', $informasi->id) }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="biaya">Biaya Registrasi :</label>
                        <div class="input-group mb-2">
                            <input type="number" name="biaya" class="form-control" id="inlineFormInputGroup"
                                value="{{ $informasi->biaya }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wa_konfirmasi">Konfirmasi Pendaftaran :</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><strong class="text-success">+62</strong></div>
                            </div>
                            <input type="text" name="wa_konfirmasi" class="form-control" id="inlineFormInputGroup"
                                placeholder="8xxxxxx" value="{{ $informasi->wa_konfirmasi }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info " type="submit"><i class="fa fa-paper-plane"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
