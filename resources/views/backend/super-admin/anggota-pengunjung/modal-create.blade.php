<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengunjung</h1>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-2">
                    <form class="row" method="POST" action="{{ route('anggota-pengunjung.store') }}">
                        @csrf
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm">
                                <label for="name" class="col-form-label">Nama Pengunjung:</label>
                                <input type="text" class="form-control" id="name" name="name"/>
                            </div>
                        </div>
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm">
                                <label for="username" class="col-form-label">Username Pengunjung:</label>
                                <input type="text" class="form-control" id="username" name="username"/>
                            </div>
                        </div>
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm">
                                <label for="email" class="col-form-label">Email Pengunjung:</label>
                                <input type="text" class="form-control" id="email" name="email"/>
                            </div>
                        </div>
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm ">
                                <label for="role" class="col-form-label">Kelas:</label>
                                <select class="form-select" name="kelas_id" id="kelas_id">
                                    <option selected disabled>Pilih Kelas</option>
                                    @foreach ($kelas as $k )
                                    <option value="{{ $k->id }}">{{ $k->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm ">
                                <label for="role" class="col-form-label">Jurusan:</label>
                                <select class="form-select" name="jurusan_id" id="jurusan_id">
                                    <option selected disabled>Pilih Jurusan</option>
                                    @foreach ($jurusan as $j )
                                    <option value="{{ $j->id }}">{{ $j->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-sm-auto col-lg-6">
                            <div class="mb-0 text-sm">
                                <label for="password" class="col-form-label">Password:</label>
                                <input type="text" class="form-control" id="password" name="password" />
                            </div>
                        </div> --}}
                        <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end gap-2 pt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
