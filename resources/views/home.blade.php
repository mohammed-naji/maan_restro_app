@extends('layouts.master')

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1>

      <select id="year" class="form-select w-25">
          @foreach (range(0, 9) as $num)
            <option value="{{ date('Y') - $num }}">{{ date('Y') - $num }}</option>
          @endforeach
      </select>

      {{-- <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar"></span>
          This week
        </button>
      </div> --}}
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
@stop

{{-- @dd($final_data) --}}

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    var data = @json($final_data);
    var data = Object.values(data)

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July ',
        'August',
        'September',
        'October',
        'November',
        'December',
      ],
      datasets: [{
        data: data,
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })



  $('#year').on('change', function() {
      let year = $(this).val();

      $.get({
          url: '{{ route("getdata") }}',
          data: {
              year: year
          },
          success: function(res) {
            var data = Object.values(res)
            myChart.data.datasets[0].data = data;
            myChart.update();
          }
      })
  })




</script>
    {{-- <script src="{{ asset('admin-assets/js/dashboard.js') }}"></script> --}}
    @stop
