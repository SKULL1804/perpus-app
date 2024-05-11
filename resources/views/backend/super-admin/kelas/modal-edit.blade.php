<div class="modal fade" id="kelas{{ $k->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{ $title }}</h1>
        </div>
        <div class="modal-body">
          <div class="container-fluid px-2">
            <form class="row" method="POST" action="{{ route('kelas.update', $k->id) }}">
                @csrf
              <div class="col-12">
                <div class="mb-lg-0">
                  <label for="name" class="col-form-label">Kelas:</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $k->name }}" />
                </div>
              </div>
              <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end gap-2 pt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
