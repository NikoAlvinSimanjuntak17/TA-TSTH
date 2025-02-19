@extends('admin.layouts.template')
@section('title','Admin | Dasboard')
@section('content')
<style>
    .grafik{
        margin-left: 10px;
        margin-right: 10px;

    }
    </style>
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
              <i class="fa fa-chart-line fa-3x text-primary"></i>
              <div class="ms-3">
                <p class="mb-2">Penjualan Hari ini</p>
                <h6 class="mb-0">Rp. {{ number_format($totalSalesToday, 2, ',', '.') }}</h6>
            </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Penjualan</p>
                    <h6 class="mb-0">Rp. {{ number_format($totalSales, 2, ',', '.') }}</h6>
                </div>
            </div>
        </div>

          <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
              <i class="fa fa-chart-area fa-3x text-primary"></i>
              <div class="ms-3">
                <p class="mb-2">Reservasi Hari Ini</p>
                <h6 class="mb-0">{{ $reservationToday }}</h6>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
              <i class="fa fa-chart-pie fa-3x text-primary"></i>
              <div class="ms-3">
                <p class="mb-2">Total Reservasi</p>
                <h6 class="mb-0">{{ $reservationCount }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>
      <div class="grafik row" style="display: flex; justify-content: center; align-items: center;">
        <!-- Kolom untuk card pertama -->
        <div class="col-sm-12 col-md-6">
            <div class="card bg-secondary fullscreen-card">
                <div class="card-body">
                    <div class="sales-stats d-flex">
                        <div>
                            <div class="text-muted fs-13">Total Pendapatan Tahun {{ $year }}</div>
                            <h3 class="fw-semibold">Rp. {{ $yeartotal }}</h3>
                        </div>
                    </div>
                    <canvas id="chartD"></canvas>
                </div>
            </div>
        </div>
        <!-- Kolom untuk card kedua -->
        <div class="col-sm-12 col-md-6">
            <div class="card bg-secondary fullscreen-card">
                <div class="card-body">
                    <div class="sales-stats d-flex">
                        <div>
                            <div class="text-muted fs-13">Reservasi Tahun {{ $year }}</div>
                            <h3 class="fw-semibold">Total {{ $yeartotalReservation }} Reservasi</h3>

                        </div>
                    </div>
                    <canvas id="chartX"></canvas>
                </div>
            </div>
        </div>



    </div>


</div>



    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="card bg-secondary  text-light">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                          </svg>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Product</span>
                  <h3 class="card-title mb-2">{{$productCount}}</h3>
                </div>
              </div>
            </div>

            <div class="col-sm-12 col-xl-6">
                <div class="card bg-secondary  text-light">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Cartegori</span>
                    <h3 class="card-title mb-2">{{$categoryCount}}</h3>
                  </div>
                </div>
              </div>




              <div class="col-sm-12 col-xl-6">
                <div class="card bg-secondary  text-light">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Order Hari ini</span>
                        <h3 class="card-title mb-2">{{$ordersToday}}</h3>
                  </div>
                </div>
              </div>


              <div class="col-sm-12 col-xl-6">
                <div class="card bg-secondary  text-light">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Feedback Hari Ini</span>
                    <h3 class="card-title mb-2">{{$feedbackToday}}</h3>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-xl-6">
                <div class="card bg-secondary  text-light">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Semua Order</span>
                    <h3 class="card-title mb-2">{{$orderCount}}</h3>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card bg-secondary  text-light">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Semua Feedback</span>
                        <h3 class="card-title mb-2">{{$feedbackCount}}</h3>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div id="content_detail"></div>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		var ctx = document.getElementById('chartD').getContext('2d');
		var chart = new Chart(ctx, {
			type: 'bar',
			data: {
			labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
			datasets: [{
				label: 'Pendapatan',
				data: [{{ $januarySum }}, {{ $februarySum }}, {{ $marchSum }}, {{ $aprilSum }}, {{ $maySum }}, {{ $juneSum }},{{ $julySum }},{{ $augustSum }},{{ $septemberSum }},{{ $octoberSum }},{{ $novemberSum }},{{ $decemberSum}}],
				backgroundColor: 'rgba(54, 162, 235, 0.5)',
				borderColor: 'rgba(54, 162, 235, 1)',
				borderWidth: 1
			}]
			},
			options: {
			scales: {
				y: {
				beginAtZero: true
				}
			}
			}
		});
	</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('chartX').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
                datasets: [{
                    label: 'Jumlah Permintaan Reservasi',
                    data: [{{ $januaryReservation }}, {{ $februaryReservation }}, {{ $marchReservation }}, {{ $aprilReservation }}, {{ $mayReservation }}, {{ $juneReservation }},{{ $julyReservation }},{{ $augustReservation }},{{ $septemberReservation }},{{ $octoberReservation }},{{ $novemberReservation }},{{ $decemberReservation}}],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>





@endsection
