<div class="modal fade" id="update{{ $nB->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update {{ $title }}</h1>
        </div>
        <div class="modal-body">
          <div class="container-fluid px-2">
            <form class="row" action="{{ route('new-book.update', $nB->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="col-6">
                <div class="row">
                    <div class="mb-lg-0">
                      <label for="judul" class="col-form-label">Judul:</label>
                      <input type="text" class="form-control" id="judul" name="judul" value="{{ $nB->judul }}" />
                    </div>
                    <div class="mb-0">
                      <label for="pengarang" class="col-form-label">Pengarang:</label>
                      <input type="text" class="form-control" id="pengarang" value="{{ $nB->pengarang }}" name="pengarang" />
                    </div>
                </div>
              </div>
              <div class="col-6">
                <div class="mb-lg-0">
                  <label for="image" class="col-form-label">Upload image new book</label>
                  <input type="file" class="form-control" id="image" name="image_new_book" />
                  <img id="showimage" src="/Backend/assets/img/new-book/{{ $nB->image_new_book  }}" class="img-fluid max-height-200 w-20 mt-3" alt="">
                </div>
                <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end gap-2 pt-4">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
