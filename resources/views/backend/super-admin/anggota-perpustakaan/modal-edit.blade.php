@foreach ($anggotaPerpustakaan as $aP)
<div class="modal fade" id="edit{{ $aP->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Anggota</h1>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-2">
                    <form class="row" action="{{ route('anggota-perpustakaan.update', $aP->id) }}" method="POST">
                        @csrf
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm">
                                <label for="name" class="col-form-label">Nama Anggota:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $aP->name }}" />
                            </div>
                        </div>
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm">
                                <label for="username" class="col-form-label">Username Anggota:</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $aP->username }}" />
                            </div>
                        </div>
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm">
                                <label for="email" class="col-form-label">Email Anggota:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $aP->email }}" />
                            </div>
                        </div>
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm ">
                                <label for="role" class="col-form-label">Posisi:</label>
                                <select class="form-select" name="role" id="role">
                                    <option selected disabled>-- Posisi --</option>
                                    <option value="super admin" {{ $aP->role === 'super admin' ? 'selected' : '' }}>super admin
                                    </option>
                                    <option value="admin" {{ $aP->role === 'admin' ? 'selected' : '' }}>admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end gap-2 pt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="update-button-{{ $aP->id }}">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- <script>
    $(document).ready(function() {
        // Ketika formulir modal dikirim
        $('form').on('submit', function(e) {
            e.preventDefault(); // Menghentikan pengiriman form bawaan browser

            var id = $(this).find('button[type=submit]').attr('id').split('-').pop();
            var formInputs = $(this).find('input, select');
            var errorsExist = false;

            formInputs.each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                var errorDivId = inputId + '-error-' + id;

                if (!inputValue) {
                    errorsExist = true;
                    $('#' + errorDivId).text('Harus diisi');
                } else {
                    $('#' + errorDivId).text('');
                }
            });

            if (!errorsExist) {
                // Lakukan validasi dengan JavaScript di sini (opsional)

                // Jika validasi JavaScript berhasil, Anda bisa kirimkan formulir menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Jika penyimpanan berhasil, Anda bisa menutup modal
                        $('#edit' + id).modal('hide');
                        // Validasi berhasil, tidak ada pesan kesalahan
                        formInputs.removeClass('is-invalid').addClass('is-valid');
                        location.reload();

                        // Tambahkan kode di sini untuk mengupdate tampilan atau memberikan pesan sukses
                        // Contoh: alert("Data berhasil disimpan");
                    },
                    error: function(response) {
                        // Japatkan pesan validasi error dari respons JSON
                        var errors = response.responseJSON.errors;
                        // Loop melalui pesan kesalahan dan menampilkan mereka di bawah setiap input yang sesuai
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error-' + id).text(value[0]);
                            // Tambahkan kelas CSS untuk menunjukkan validasi gagal
                            $('#' + key + '-' + id).removeClass('is-valid').addClass('is-invalid');
                        });
                    }
                });

            }
        });
    });
</script> --}}


