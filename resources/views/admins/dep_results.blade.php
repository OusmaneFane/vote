@extends('admins.dashboard2')

@section("content")

<style>
    .chart-legend {
        margin-top: 10px;
        font-size: 14px;
        display: flex;
        flex-wrap: wrap;
    }

    .legend-item {
        margin-right: 15px;
        display: inline-flex;
        align-items: center;
    }

    .legend-item::before {
        content: '\25A0'; /* Utilisez le caractère carré noir comme symbole de la légende */
        margin-right: 5px;
        font-size: 18px;
    }
</style>

 <div class="page-header">
        <h3 class="page-title">
            Flot chart
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Charts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Flot chart</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pie chart</h4>
                    <div class="flot-chart-container">
                        <div id="custom-pie-chart" class="flot-chart"></div>
                        <div class="chart-legend">
                    @foreach ($pieChartData as $data)
                        <span class="legend-item" style="color: {{ $data['color'] }};"> {{ $data['label'] }} ({{ number_format($data['data'], 2) }}%)</span> <br>
                    @endforeach
                </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bar Chart</h4>
                    <div class="flot-chart-container">
                        <div id="column-chart-pie" class="flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot@0.8.3/jquery.flot.pie.min.js"></script>


    <script>
        // Pie Chart
 var customPieChartOptions = {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        };

        $.plot("#custom-pie-chart", {!! json_encode($pieChartData) !!}, customPieChartOptions);

        function labelFormatter(label, series) {
            return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }

        // Script pour le column chart
  $(function() {

        var barChartData = {!! json_encode($barChartData) !!};

        // Extraire les noms des candidats depuis barChartData
        var candidates = barChartData.map(function(entry) {
            return entry[0];
        });

        // Extraire les valeurs (nombre de votes) des candidats depuis barChartData
        var votes = barChartData.map(function(entry) {
            return entry[1];
        });

        var data = [];

        // Construire le tableau de données avec les noms des candidats et les valeurs
        for (var i = 0; i < candidates.length; i++) {
            data.push([candidates[i], votes[i]]);
        }

    if ($("#column-chart-pie").length) {
      $.plot("#column-chart-pie", [data], {
        series: {
          bars: {
            show: true,
            barWidth: 0.6,
            align: "center"
          }
        },
        xaxis: {
          mode: "categories",
          tickLength: 0
        },

        grid: {
          borderWidth: 0,
          labelMargin: 10,
          hoverable: true,
          clickable: true,
          mouseActiveRadius: 6,
        }

      });
    }
  });     
  </script>
     
@endsection