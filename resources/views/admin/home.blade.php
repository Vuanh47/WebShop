@extends('admin.main')
<style>
  .order-link:hover {
    color: black;
    /* Màu khi hover (đen) */
  }
</style>

@section('content')
<div class="row m-2">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$count_order}}</h3>

        <p class="text-light">Đơn Hàng</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer text-light">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$comments}}</h3>

        <p class="text-light">Bình Luận</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer text-light">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{$count_customer}}</h3>

        <p>Khách Hàng Đăng Kí</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer text-light">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h4 class="text-light mt-3">{{formatCurrency($total_price)}}</h4>

        <p class="text-light text-light">Tổng Doanh Thu</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer text-light">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>


  <!-- ./col -->
</div>
<div class="container mt-5">
  <div class="row">
    <!-- Card 2 -->
    <div class="col-md-6">
      <div class="card" style="max-width: 500px; height: 460px; padding: 1rem;">
        <div class="card-header border-0">
          <h3 class="text-danger">Đơn Hàng Mới </h3>

          <i class="fa-solid fa-bag-shopping ms-auto" style="color: #3c12ba;"></i>

        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-striped table-valign-middle">
            <thead>
              <tr>
                <th>Mã Đơn Hàng</th>
                <th>Thời gian</th>
                <th>Giá</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              <tr>
                <td>
                  <a href="{{route('order.detail', $order->id)}}" class="order-link">{{$order->id}}</a>
                </td>
                <td>
                  <small class="text-success mr-1">
                    {{ $order->created_at->format('d/m/Y  H:i') }}
                </td>
                <td>{{formatCurrency($order->total_price)}}</td>

              </tr>
              @endforeach

              <!-- Additional rows -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Card 1 -->
    <div class="col-md-6 mb-3">
      <div class="card" style="max-width: 500px; max-height: 460px; padding: 1rem;">
        <div class="card-header bg-white">
          <h5 class="mb-0">Online Store Visitors</h5>
          <a href="#" class="text-primary">View Report</a>
        </div>
        <div class="card-body">
          <h2 class="mb-0">820</h2>
          <p class="text-muted">Visitors Over Time</p>
          <div class="d-flex align-items-center">
            <i class="fas fa-arrow-up text-success"></i>
            <span class="text-success ms-1">12.5%</span>
            <span class="text-muted ms-2">Since last week</span>
          </div>
          <div class="chart-container mt-3">
            <canvas id="visitorsChart"></canvas>
          </div>
          <div class="d-flex justify-content-center mt-3">
            <div class="me-3">
              <i class="fas fa-square text-primary"></i> This Week
            </div>
            <div>
              <i class="fas fa-square text-secondary"></i> Last Week
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>


@endsection
@section('footer')
<script>
  var ctx = document.getElementById('visitorsChart').getContext('2d');
  var visitorsChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        label: 'This Week',
        data: [100, 120, 140, 160, 160, 140, 130],
        borderColor: '#007bff',
        backgroundColor: 'rgba(0, 123, 255, 0.1)',
        fill: false,
        tension: 0.1
      }, {
        label: 'Last Week',
        data: [0, 90, 100, 110, 110, 100, 90],
        borderColor: '#6c757d',
        backgroundColor: 'rgba(108, 117, 125, 0.1)',
        fill: false,
        tension: 0.1
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          beginAtZero: true
        },
        y: {
          beginAtZero: true,
          max: 200
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
</script>
@endsection
@section('header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  a {
    text-decoration: none;
    color: #007bff;

  }

  a:hover {
    color: yellow;
    text-decoration: none;
  }


  .card {
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: none;
  }

  .card-body {
    padding: 1rem 1.5rem;
  }

  .text-success {
    color: #28a745 !important;
  }

  .chart-container {
    position: relative;
    height: 200px;
  }
</style>
@endsection