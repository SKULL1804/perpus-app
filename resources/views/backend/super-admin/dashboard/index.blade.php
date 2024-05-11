@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <!-- Add Buku View -->
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Buku Yang Tersedia</p>
                  <h5 class="font-weight-bolder">{{ $DaftarBukuCount }}</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="ni ni-fat-add text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Add Buku View -->

      <!-- Today's Users View -->
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Buku baru yang tersedia</p>
                  <h5 class="font-weight-bolder">{{ $newBookCount }}</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                  <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Today's Users View -->

      <!-- New Users View -->
      {{-- <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Pengguna Baru</p>
                  <h5 class="font-weight-bolder">+3,462</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                  <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- End New Users view -->
    </div>
    <div class="row mt-4">
      {{-- <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
          <div class="card-header pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize">Grafik Pengunjung</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-arrow-up text-success"></i>
              <span class="font-weight-bold">4% more</span> in 2021
            </p>
          </div>
          <div class="card-body p-3">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Data Pengunjung</h6>
          </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($dataPengunjung as $dP )
                  <tr>
                    <td>
                      <div class="d-flex flex-column justify-content-center px-3">
                        <h6 class="mb-0 text-sm">{{ $dP->name }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $dP->email }}</p>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $dP->kelas->name }}</p>
                      <p class="text-xs text-secondary mb-0">{{ $dP->jurusan->name }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      @if (Cache::has('is-online'.$dP->id))
                          <span class="badge badge-sm bg-gradient-success">Active</span>
                      @else
                          <span class="badge badge-sm bg-gradient-danger">In-Active</span>
                      @endif
                      <p class="text-xs text-secondary mb-0">{{ Carbon\Carbon::parse($dP->terakhir_terlihat)->diffForHumans() }}</p>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <div class="px-4 pt-2">
            {!! $dataPengunjung->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
        </div>
        </div>
      </div>
    </div>
</div>

{{-- @push('script')
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, "rgba(94, 114, 228, 0.2)");
    gradientStroke1.addColorStop(0.2, "rgba(94, 114, 228, 0.0)");
    gradientStroke1.addColorStop(0, "rgba(94, 114, 228, 0)");
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
          {
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#5e72e4",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
            },
            ticks: {
              display: true,
              padding: 10,
              color: "#fbfbfb",
              font: {
                size: 11,
                family: "Open Sans",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5],
            },
            ticks: {
              display: true,
              color: "#ccc",
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
        },
      },
    });
</script>
@endpush --}}
@endsection
