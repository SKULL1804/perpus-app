<!-- Modal View -->
@foreach ($anggotaPengunjung as $aP)
<div class="modal fade" id="view{{ $aP->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="viewModalLabel">Detail Pengunjung</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <p class="text-bold mb-1">Nama:</p>
                                <p class="text-secondary">{{ $aP->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <p class="text-bold mb-1">Username:</p>
                                <p class="text-secondary">{{ $aP->username }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <p class="text-bold mb-1">Kelas:</p>
                                <p class="text-secondary">{{ $aP->kelas->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <p class="text-bold mb-1">Jurusan:</p>
                                <p class="text-secondary">{{ $aP->jurusan->name }}</p>
                            </div>
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
