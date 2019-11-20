@extends('layouts.templates')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('styles')
    <style>
      .card_percent {
        font-size : 30px ;
      }
    </style>
@endsection

@section('content')
<div class="container-fluid">

        <div class="row">
          <div class="col-4">
            <div class="card">
              <div class="card-body py-4">
                <div class="float-right"><i class="fa fa-history"></i> <span>1 Bulan terakhir<span></div>
                {{-- <div class="text-value-lg">Rp. </div> --}}
                <div>Uang Masuk</div>
                <div class="mt-3 card_percent">
                    Rp. {{ format_uang($uangmasuk['now']) }}

                  <div class="float-right">
                      {!! $uangmasuk['status'] !!}
                      {{ $uangmasuk['persen'] }}%
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
          <div class="col-4">
            <div class="card">
              <div class="card-body py-4">
                <div class="float-right"><i class="fa fa-history"></i> <span>1 Bulan terakhir<span></div>
                {{-- <div class="text-value-lg">Rp. </div> --}}
                <div>Uang Keluar</div>
                <div class="mt-3 card_percent">
                    Rp. {{ format_uang($uangkeluar['now']) }}

                  <div class="float-right">
                      {!! $uangkeluar['status'] !!}
                      {{ $uangkeluar['persen'] }}%
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
          <div class="col-4">
              <div class="card">
                <div class="card-body py-4">
                  <div class="float-right"><i class="fa fa-history"></i> <span>Minggu Terakhir<span></div>
                  {{-- <div class="text-value-lg">Rp. </div> --}}
                  <div>Jumlah Jamaah</div>
                  <div class="mt-3 card_percent">
                      {{ $jamaah['now'] }}
  
                    <div class="float-right">
                        {!! $jamaah['status'] !!}
                        {{ $jamaah['persen'] }}%
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
    
          <!-- /.col-->
        </div>
        <!-- /.row-->
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-5">
                <h4 class="card-title mb-0">Traffic Jama'ah Kajian</h4>
                <div class="small text-muted">Last {{ $main_chart['count'] }} Weeks <i class="fa fa-history"></i></div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
              <canvas class="chart" id="main-chart" height="300"></canvas>
            </div>
          </div>
        </div>
        <!-- /.card-->
        <div class="row">
          {{-- <div class="col-sm-6">
            <div class="card">
              <div class="card-header bg-facebook content-center">
                <span class="c-icon c-icon-3xl text-white mb-4">
                  <i class="fa fa-facebook"></i>
                </span>
                <div class="c-chart-wrapper">
                  <canvas id="social-box-chart-1" height="90"></canvas>
                </div>
              </div>
              <div class="card-body row text-center">
                <div class="col">
                  <div class="text-value-xl">89k</div>
                  <div class="text-uppercase text-muted small">friends</div>
                </div>
                <div class="c-vr"></div>
                <div class="col">
                  <div class="text-value-xl">459</div>
                  <div class="text-uppercase text-muted small">feeds</div>
                </div>
              </div>
              <div class="card-footer">
                Visit <a href="https://www.facebook.com/parapejuangtauhid/">Para Pejuang Tauhid</a>
              </div>
            </div>
          </div> --}}
          <!-- /.col-->
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header bg-instagram content-center">
                <span class="c-icon c-icon-3xl text-white mb-4">
                  <i class="fa fa-instagram"></i>
                </span>
              
                <div class="c-chart-wrapper">
                  <canvas id="social-box-chart-2" height="90"></canvas>
                </div>
              </div>
              <div class="card-body row text-center">
                <div class="col">
                  <div class="text-value-xl">{{ $instagram['followedBy'] }}</div>
                  <div class="text-uppercase text-muted small">followers</div>
                </div>
                <div class="c-vr"></div>
                <div class="col">
                  <div class="text-value-xl">{{ $instagram['follows'] }}</div>
                  <div class="text-uppercase text-muted small">Following</div>
                </div>
              </div>
              <div class="card-footer text-center">
                {{ $instagram['bio'] }} <br>
              
              Visit <a href="https://www.instagram.com/parapejuangtauhid/">Para Pejuang Tauhid</a> 
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->
        
      </div>
@endsection

@section('scripts')
 <script>
   var mainChart = new Chart(document.getElementById('main-chart'), {
  type: 'line',
  data: {
    labels: {!! json_encode($main_chart['tanggal']) !!},
    datasets: [{
      label: 'My First dataset',
      backgroundColor: hexToRgba(getStyle('--info'), 10),
      borderColor: getStyle('--info'),
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: {!! json_encode($main_chart['jamaah']) !!}
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          drawOnChartArea: false
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true,
          maxTicksLimit: 11,
          stepSize: 1,
          max: 50
        }
      }]
    },
    elements: {
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4,
        hoverBorderWidth: 3
      }
    }
  }
});
    </script>
@endsection