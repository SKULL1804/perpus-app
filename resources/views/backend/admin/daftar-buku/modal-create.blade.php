<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Daftar Buku</h1>
        </div>
        <div class="modal-body">
          <div class="container-fluid px-2">
            <form class="row" method="POST" action="{{ route('admin-daftar-buku.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="col-4">
                <div class="mb-lg-0">
                  <label for="kode_buku" class="col-form-label">Kode Buku:</label>
                  <input type="text" class="form-control" id="kode_buku" name="kode_buku" />
                </div>
              </div>
              <div class="col-4">
                <div class="mb-lg-0">
                  <label for="judul" class="col-form-label">Judul:</label>
                  <input type="text" class="form-control" id="judul" name="judul"/>
                </div>
              </div>
              <div class="col-4">
                <div class="mb-0">
                  <label for="pengarang" class="col-form-label">Pengarang:</label>
                  <input type="text" class="form-control" id="pengarang" name="pengarang" />
                </div>
              </div>
              <div class="col-4">
                <div class="mb-0">
                  <label for="penerbit" class="col-form-label">Penerbit:</label>
                  <input type="text" class="form-control" id="penerbit" name="penerbit" />
                </div>
              </div>
               <div class="col-4">
                  <div class="mb-0">
                    <label for="kategori_buku_id" class="col-form-label">Kategori Buku:</label>
                    <select class="form-select" aria-label="kategori_buku_id" name="kategori_buku_id">
                      <option selected disabled>-- Kategori Buku --</option>
                      @foreach ($kategoriBuku as $kB)
                      <option value="{{ $kB->id }}">{{ $kB->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              <div class="col-4">
                <div class="mb-0">
                  <label for="file_buku" class="col-form-label">Upload File:</label>
                  <input type="file" class="form-control" id="file_buku" name="file_buku" />
                </div>
              </div>
              <div class="col-7">
                <div class="mb-lg-0">
                  <label for="image" class="col-form-label">Upload Img Buku</label>
                  <input type="file" class="form-control" id="image" name="image_buku" />
                  <img id="showimage" src="{{ url('Backend/assets/img/no-image.png') }}" class="img-fluid max-height-200 w-20 mt-3" alt="">
                </div>
              </div>
              <div class="col-5">
                <div class="mb-0">
                  <label for="tanggal_terbit" class="col-form-label">Tanggal Terbit:</label>
                  <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" />
                </div>
              </div>
              <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end gap-2 pt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Show Image -->
<script src="{{ asset('js/show-image.js') }}"></script>
