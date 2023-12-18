@extends('admins.dashboard2')

@section("content")



 <div class="page-header">
        <h3 class="page-title">
           Résultas des décomptes
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Résultas des décomptes</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> STATISTIQUE 1 des Votes</h4>
                    <div class="flot-chart-container">
                                           <canvas id="sales-status-chart-pie" class="mt-3"></canvas>
                    <div class="pt-4">
                      <div id="sales-status-chart-legend" class="sales-status-chart-legend"></div>
                    </div>

                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">STATISTIQUE 2 des Votes</h4>
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
    $(function () {
        @php
            $pieLabels = [];
            $pieData = [];
            
            foreach ($pieChartData as $data) {
                $pieLabels[] = $data['label'];
                $pieData[] = $data['data'];
            }
        @endphp

        if ($("#sales-status-chart-pie").length) {
            var pieChartCanvas = $("#sales-status-chart-pie").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: @json($pieData),
                        backgroundColor: @json(array_column($pieChartData, 'color')),
                        borderColor: @json(array_column($pieChartData, 'color')),
                    }],
                    labels: @json($pieLabels)
                },
                options: {
                    responsive: true,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: {
                        display: false
                    },
                    
                    legendCallback: function (chart) {
                        var text = [];
                        text.push('<ul class="legend' + chart.id + '">');
                        for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                            text.push('<li><span class="legend-label" style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '"></span>');
                            if (chart.data.labels[i]) {
                                text.push(chart.data.labels[i]);
                            }
                            text.push('<label class="badge badge-light badge-pill legend-percentage ml-auto">' + chart.data.datasets[0].data[i].toFixed(2) + '%</label>');
                            text.push('</li>');
                        }
                        text.push('</ul>');
                        return text.join("");
                    }
                }
            });
            document.getElementById('sales-status-chart-legend').innerHTML = pieChart.generateLegend();
        }
    });
</script>
    <script>
        // Pie Chart

        // Script pour le column chart
// Pie Chart
$(function() {
    var barChartData = {!! json_encode($barChartData) !!};

    var candidates = barChartData.map(function(entry) {
        return entry[0];
    });

    var votes = barChartData.map(function(entry) {
        return entry[1];
    });

    var data = [];

    for (var i = 0; i < candidates.length; i++) {
        // Remplacez le nom du candidat par son numéro
        var candidateNumber = "N*" + (i + 1);
        data.push([candidateNumber, votes[i]]);
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
                mouseActiveRadius: 6
            },
            xaxes: [{
                axisLabel: "Candidats",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: "Arial",
                axisLabelPadding: 10,
                rotateTicks: 45 // Angle de rotation
            }]
        });
    }
});
  </script>
     
@endsection