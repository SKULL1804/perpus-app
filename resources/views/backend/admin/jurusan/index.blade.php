@extends('backend.admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center">
            <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#jurusan"><i class="fa-solid fa-plus me-2"></i>Tambah</button>
            @include('backend.super-admin.jurusan.modal-create')
            <div class="ms-md-auto pe-md-3 d-flex align-items-center ms-4">
                <form method="GET">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Seacrh ..." name="search" value="{{$search}}" />
                    </div>
                </form>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Jurusan</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                    @php
                    $ids = 1 + (($jurusan->currentPage() - 1) * $jurusan->perPage());
                    @endphp
                    @if (count($jurusan))
                        @foreach ($jurusan as $j )
                        <tr>
                          <td>
                            <p class="text-secondary text-xs font-weight-bold mb-0 ps-2">{{ $ids++ }}</p>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $j->name }}</p>
                          </td>
                          <td class="d-flex gap-2">
                            <button type="button" class="btn btn-success mb-0" data-bs-toggle="modal" data-bs-target="#jurusan{{ $j->id }}">Edit</button>
                            @include('backend.super-admin.jurusan.modal-edit')
                          </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center ps-12">
                            <p class="text-secondary text-xs font-weight-bold mb-0">
                                Tidak ada data {{ $title }}
                            </p>
                        </td>
                    </tr>
                    @endif
                </tbody>
              </table>
            </div>
            <div class="px-4 pt-2">
                {!! $jurusan->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
