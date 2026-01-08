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
                    @php
                        $dates = [
                            'launching' => $informasi->launching,
                            'mulai_kbm' => $informasi->mulai_kbm,
                            'mabit' => $informasi->mabit,
                            'jalasah' => $informasi->jalasah,
                            'talkshow' => $informasi->talkshow,
                        ];
                    @endphp

                    @foreach ($dates as $key => $value)
                        <div class="form-group">
                            <label>{{ strtoupper(str_replace('_', ' ', $key)) }}</label>
                            <input type="text" class="form-control datepicker" name="{{ $key }}"
                                value="{{ $value ? \Carbon\Carbon::parse($value)->format('d/m/Y') : '' }}">
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="submit"><i class="fa fa-paper-plane"></i> Update</button>
                </div>
            </form>


        </div>
    </div>
</div>

@push('css')
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
@endpush

@push('js')
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy', // tampilannya dd/mm/yyyy
                autoclose: true
            });

            // konversi dd/mm/yyyy ke yyyy-mm-dd saat submit
            $('form').on('submit', function() {
                $('.datepicker').each(function() {
                    let val = $(this).val();
                    if (val) {
                        let parts = val.split('/');
                        if (parts.length === 3) {
                            let iso = parts[2] + '-' + parts[1] + '-' + parts[0]; // yyyy-mm-dd
                            $(this).val(iso);
                        }
                    }
                });
            });
        });
    </script>
@endpush
