<div class="modal fade" id="edit{{ $dB->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{ $title }}</h1>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-2">
                    <form class="row" action="{{ route('daftar-buku.update', $dB->id) }}" method="POST" enctype="multipart/form-data" id="editForm-{{ $dB->id }}">
                        @csrf
                        <div class="col-4">
                            <div class="mb-lg-0">
                                <label for="kode_buku" class="col-form-label">Kode Buku:</label>
                                <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="{{ $dB->kode_buku }}" />
                                <span class="text-danger" id="kode_buku-error-{{ $dB->kode_buku }}"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-lg-0">
                                <label for="judul" class="col-form-label">Judul:</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $dB->judul) }}" />
                                <span class="text-danger" id="judul-error-{{ $dB->judul }}"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-0">
                            <label for="pengarang" class="col-form-label">Pengarang:</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ old('pengarang', $dB->pengarang) }}" />
                            <span class="text-danger" id="pengarang-error-{{ $dB->pengarang }}"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-0">
                            <label for="penerbit" class="col-form-label">Penerbit:</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit', $dB->penerbit )}}" />
                            <span class="text-danger" id="penerbit-error-{{ $dB->penerbit }}"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-0">
                            <label for="kategori_buku_id" class="col-form-label">Kategori:</label>
                            <select class="form-select" aria-label="kategori_buku_id" name="kategori_buku_id" id="kategori_buku_id">
                                <option selected disabled>-- Kategori Buku --</option>
                                    @foreach ($kategoriBuku as $kB)
                                <option value="{{ $kB->id }}"{{$kB->id == $dB->kategori_buku_id ? 'selected' : '' }}>{{ $kB->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="kategori_buku_id-error-{{ $dB->kategori_buku_id }}"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-0">
                            <label for="file_buku" class="col-form-label">Upload File:</label>
                            <input type="file" class="form-control @error('file_buku') is-invalid @enderror" id="file_buku" name="file_buku"/>
                            <div id="file_buku-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="mb-lg-0">
                            <label for="image" class="col-form-label">Update Image Buku</label>
                            <input type="file" class="form-control" id="image" name="image_buku"/>
                            <img id="showimage" src="Backend/assets/img/daftar-buku/{{ $dB->image_buku  }}" class="img-fluid max-height-200 w-20 mt-3" alt="">
                            <div id="image_buku-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mb-0">
                            <label for="tanggal_terbit" class="col-form-label">Tanggal Terbit:</label>
                            <input type="date" class="form-control" id="tanggal_terbit" value="{{ old('tanggal_terbit', $dB->tanggal_terbit) }}" name="tanggal_terbit" />
                            <div id="tanggal_terbit-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- Tambahkan field lainnya di sini -->
                        <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end gap-2 pt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="update-button-{{ $dB->id }}">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // When the "Update" button is clicked
        $('button[id^="update-button"]').on('click', function() {
            var id = $(this).attr('id').split('-').pop();
            var form = $('#editForm-' + id);
            var formInputs = form.find('input');
            var errorsExist = false;

            formInputs.each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                var errorDivId = inputId + '-error-' + id;
                var errorDiv = $('#' + errorDivId);

                if (!inputValue) {
                    errorsExist = true;
                    errorDiv.text('Harus diisi');
                } else {
                    errorDiv.text('');
                }
            });

            if (!errorsExist) {
                // Do the JavaScript validation here (optional)

                // If JavaScript validation is successful, submit the form using AJAX
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        $('#edit' + id).modal('hide');
                        location.reload();
                        // Add code here to update the view or display a success message
                        // Example: alert("Data berhasil disimpan");
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error-' + id).text(value[0]);
                        });
                    }
                });
            }
        });
    });
</script>
