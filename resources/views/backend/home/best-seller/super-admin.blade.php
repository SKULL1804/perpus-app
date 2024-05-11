@extends('backend.super-admin.layouts.app')

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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Daftar Buku Banyak Di Baca</th>
                  </tr>
                </thead>
                <tbody>
                    @php( $ids = 1)
                    @foreach ( $bestBook as $bB )
                    @if ($bB['jumlah_baca'] > 0)
                    <tr>
                      <td>
                        <div class="d-flex flex-row align-items-center px-3">
                            <p class="text-secondary text-xs font-weight-bold mb-0 ps-2">{{ $ids++ }}</p>
                            <div class="ms-1">
                                <img src="{{ asset('/Backend/assets/img/daftar-buku/' . $bB['image']) }}" alt="{{ $bB['judul_buku'] }}" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                            </div>
                            <div class="ms-2">
                                <p class="mb-0 text-xs text-bolder text-uppercase">{{ $bB['judul_buku'] }}</p>
                                <p class="mb-0 text-xs text-secondary">{{ $bB['jumlah_baca'] }} Kali</p>
                                <p class="mb-0 text-xs text-secondary">{{ $bB['pengarang'] }}</p>
                            </div>
                        </div>
                      </td>
                      {{-- <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $bS->pengarang }}</p>
                      </td>
                      <td>
                          <div>
                            <img src="Backend/assets/img/best-seller/{{ $bS->image_best_seller  }}" class="img-fluid max-height-200 w-30" style="object-fit: contain;" alt="">
                          </div>
                        </td>
                      <td>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success mb-0" data-bs-toggle="modal" data-bs-target="#update{{ $bS->id }}">Update</button>
                              @include('backend.home.best-seller.modal-update')
                        </div>
                      </td> --}}
                    </tr>
                    @endif
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
