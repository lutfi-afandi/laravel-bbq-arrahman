<div class="modal fade" tabindex="1" id="modal-agenda1">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header p-1 pl-3 pr-3 bg-gradient-cyan">
                <h4 class="modal-title  text-center">Jadwal Agenda BBQ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form method="post" action="{{ route('admin.informasi.agenda', $informasi->id) }}">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">LAUNCHING</label>
                        <input type="date" name="launching" class="form-control" id=""
                            value="{{ $informasi->launching }}">
                    </div>
                    <div class="form-group">
                        <label for="">MULAI KBM</label>
                        <input type="date" name="mulai_kbm" class="form-control" id=""
                            value="{{ $informasi->muali_kbm }}">
                    </div>
                    <div class="form-group">
                        <label for="">MABIT</label>
                        <input type="date" name="mabit" class="form-control" id=""
                            value="{{ $informasi->mabit }}">
                    </div>
                    <div class="form-group">
                        <label for="">JALASAH</label>
                        <input type="date" name="jalasah" class="form-control" id=""
                            value="{{ $informasi->jalasah }}">
                    </div>
                    <div class="form-group">
                        <label for="">TALKSHOW</label>
                        <input type="date" name="talkshow" class="form-control" id=""
                            value="{{ $informasi->talkshow }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-info " type="submit"><i class="fa fa-paper-plane"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
