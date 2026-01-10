<div class="modal fade" id="modal-agenda1" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-lg">

            <!-- Header -->
            <div class="modal-header bg-gradient-cyan py-2">
                <h5 class="modal-title text-white">
                    <i class="fas fa-calendar-alt mr-2"></i> Jadwal Agenda BBQ
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.informasi.agenda', $informasi->id) }}">
                @method('put')
                @csrf

                <div class="modal-body px-4 py-3">

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
                            <label class="font-weight-bold text-uppercase small">
                                {{ str_replace('_', ' ', $key) }}
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white">
                                        <i class="far fa-calendar text-info"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker" name="{{ $key }}"
                                    value="{{ $value ? \Carbon\Carbon::parse($value)->format('d/m/Y') : '' }}"
                                    placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-info btn-sm px-4 shadow-sm" type="submit">
                        <i class="fas fa-save mr-1"></i> Simpan Agenda
                    </button>
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
