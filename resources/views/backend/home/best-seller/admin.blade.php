@extends('backend.admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengarang</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Book Picture</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                    @php( $ids = 1)
                    @foreach ( $bestSeller as $bS )
                    <tr>
                      <td>
                        <p class="text-secondary text-xs font-weight-bold mb-0 ps-2">{{ $ids++ }}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $bS->judul }}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $bS->pengarang }}</p>
                      </td>
                      <td>
                          <div>
                            <img src="/Backend/assets/img/best-seller/{{ $bS->image_best_seller  }}" class="img-fluid max-height-200 w-30" style="object-fit: contain;" alt="">
                          </div>
                        </td>
                      <td>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success mb-0" data-bs-toggle="modal" data-bs-target="#update{{ $bS->id }}">Update</button>
                              @include('backend.home.best-seller.modal-update')
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
