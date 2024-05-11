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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pe-">Daftar Buku Terbaru</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                    @php( $ids = 1)
                    @foreach ( $newBook as $nB )
                    <tr>
                        <td>
                            <div class="d-flex flex-row align-items-center px-3">
                                <p class="text-secondary text-xs font-weight-bold mb-0 ps-2">{{ $ids++ }}</p>
                                <div class="ms-2">
                                    <img src="Backend/assets/img/daftar-buku/{{ $nB->image_buku  }}" class="avatar" style="object-fit: contain;" alt="">
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-0 text-xs text-bolder text-uppercase">{{ $nB->judul }}</h6>
                                    <p class="mb-0 text-xs text-secondary">{{ $nB['kategoriBuku']['name'] }}</p>
                                    <p class="mb-0 text-xs text-secondary">{{ $nB->pengarang }}</p>
                                </div>
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
