@extends('backend.admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container-fluid p-4">
                        <form class="row"  action="{{ route('admin-motto.update', $motto->id) }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="mb-lg-0">
                                    <label for="ajakan" class="col-form-label">Ajakan:</label>
                                    <textarea class="form-control" rows="3" id="ajakan" name="ajakan">{{ $motto->ajakan }}</textarea>
                                </div>
                            </div>
                            <div class="col-12  ">
                                <div class="mb-lg-0">
                                    <label for="motto" class="col-form-label">Motto:</label>
                                    <textarea class="form-control" rows="3" id="motto" name="motto">{{ $motto->motto }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end pt-2">
                                <button type="submit" class="btn btn-success btn-sm mb-0">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

