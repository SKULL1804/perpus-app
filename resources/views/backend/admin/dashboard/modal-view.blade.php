<!-- Modal View -->
@foreach ($daftarBuku as $dB)
<div class="modal fade" id="view{{ $dB->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="viewModalLabel">Detail Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <p class="mb-0 text-bold">Kode Buku</p>
                                <p class="text-xs text-secondary mb-0">{{ $dB->kode_buku }}</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="mb-0 text-bold">Judul</p>
                                <p class="text-xs text-secondary mb-0">{{ $dB->judul }}</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="mb-0 text-bold">Kategori</p>
                                <p class="text-xs text-secondary mb-0">{{ $dB['kategoriBuku']['name'] }}</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="mb-0 text-bold">Pengarang</p>
                                <p class="text-xs text-secondary mb-0">{{ $dB->pengarang }}</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="mb-0 text-bold">Penerbit</p>
                                <p class="text-xs text-secondary mb-0">{{ $dB->penerbit }}</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="mb-0 text-bold">Tanggal Terbit</p>
                                <p class="text-xs text-secondary mb-0">{{ date('d-m-Y', strtotime($dB->tanggal_terbit)) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="/Backend/assets/img/daftar-buku/{{ $dB->image_buku }}" class="img-fluid" alt="Foto Buku">
                            <p class="text-xs text-center text-secondary mb-0 mt-3">{{ $dB->file_buku }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
