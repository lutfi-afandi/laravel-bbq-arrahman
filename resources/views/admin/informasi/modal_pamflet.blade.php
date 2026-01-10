<div class="modal fade" id="modal-pamflet1" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-lg">

            <!-- Header -->
            <div class="modal-header bg-gradient-yellow py-2">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-image mr-2"></i> Update Pamflet BBQ
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.informasi.pamflet', $informasi->id) }}"
                enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="modal-body px-4 py-3">

                    <!-- Preview -->
                    <div class="text-center mb-3">
                        <img id="previewPamflet" src="{{ asset('storage/pamflet/' . $informasi->pamflet) }}"
                            class="img-fluid rounded shadow-sm border" style="max-height:200px;">
                        <div class="small text-muted mt-1">Preview pamflet saat ini</div>
                    </div>

                    <!-- Upload -->
                    <div class="form-group">
                        <label class="font-weight-bold small">Upload Pamflet Baru</label>
                        <div class="custom-file">
                            <input type="file" name="pamflet" class="custom-file-input" id="pamfletInput"
                                accept="image/*">
                            <label class="custom-file-label" for="pamfletInput">Pilih file...</label>
                        </div>
                        <small class="text-muted">Format: JPG, PNG • Maks 2MB</small>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-info btn-sm px-4 shadow-sm" type="submit">
                        <i class="fas fa-upload mr-1"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById('pamfletInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewPamflet').src = e.target.result;
        }
        reader.readAsDataURL(file);

        // tampilkan nama file
        this.nextElementSibling.innerText = file.name;
    });
</script>
