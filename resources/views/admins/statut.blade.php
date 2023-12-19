@extends('admins.dashboard2')

@section("content")
          <div class="page-header">
            <h3 class="page-title">
              Statistique des votes en ligne
            </h3>
          </div>
          <div class="row grid-margin">
            <div class="col-12">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">

                    @foreach($candidats as $candidat )
                      <div class="statistics-item">
                        <p>
                         <img class="rounded-circle" height="50" width="50" src="/storage/candidats/{{$candidat->photo}}" alt="">
                         {{$candidat->nom}}
                        </p>
                        <h2 id="totalVotes-{{$candidat->id}}">{{ $candidat->totalVotes }}</h2>
                        <label class="badge badge-outline-primary badge-pill"><b><span id="pourcentage-{{$candidat->id}}">{{ number_format($candidat->percentageVotes, 2) }}</span>% de voix</b></label>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fas fa-gift"></i>
                    Statistique des votes en ligne
                  </h4>
                  <canvas id="votes-chart"></canvas>
                  <div id="votes-chart-legend" class="orders-chart-legend"></div>                  
                </div>
              </div>
            </div>
          <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <i class="fa fa-users"></i>
                    Total des votes
                  </h4>
                   <button class="btn btn-primary" ><span id="btnTotal">{{$totalVotes}}</span> Vote(s) au total
                      </button >
                       @foreach($candidats as $candidat )
                        @if($candidat->nom == 'VOTE NUL')
                         <button class="btn btn-danger" ><span id="btnVoteNul">{{ $candidat->totalVotes }}</span> vote(s) nul(s)                      
                         </button>
                      @endif
                      @endforeach 
                      
                  <ul class="solid-bullet-list mt-4">
                     @foreach($candidats as $candidat )
                    <li>
                      <h5 id="totalVotes-{{$candidat->id}}">{{ $candidat->totalVotes }} voix enregistré(s)
                      </h5>
                      <p class="text-muted">{{ $candidat->nom }} </p>

                    </li>
                    @endforeach
`

                    <li>
                     
                    </li>
                    
                  </ul>

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    Sales status
                  </h4>
                  <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="sales-status-chart-pie" class="mt-3"></canvas>
                    <div class="pt-4">
                      <div id="sales-status-chart-legend" class="sales-status-chart-legend"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function () {
        @php
            $candidates = [];
            $votes = [];
            $totalVotes = $totalVotes; 
            
            foreach ($barChartData as $data) {
                $candidates[] = $data[0];
                $votes[] = $data[1]; // Utilisez la véritable valeur des votes
            }
        @endphp

        let candidats = @json($candidates)

        let votes = @json($votes)

        
        if ($("#votes-chart").length) {
          var votesChartCanvas = $("#votes-chart").get(0).getContext("2d");
          var votesChart = new Chart(votesChartCanvas, {
              type: 'bar',
              data: {
                  labels:(candidats),
                  datasets: [
                      {
                          label: 'Votes',
                          data: (votes),
                          backgroundColor: '#392c70'
                      }
                  ]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: true,
                  layout: {
                      padding: {
                          left: 0,
                          right: 0,
                          top: 20,
                          bottom: 0
                      }
                  },
                  scales: {
                      yAxes: [
                          {
                              gridLines: {
                                  drawBorder: false,
                              },
                              ticks: {
                                  stepSize: 1, // Ajustez la gradation en fonction de vos besoins
                                  beginAtZero: true,
                                  fontColor: "#686868"
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'Votes',
                                  fontColor: "#686868"
                              }
                          }
                      ],
                      xAxes: [
                          {
                              ticks: {
                                  fontColor: "#686868",
                                    minRotation: 45,
                              },
                              gridLines: {
                                  display: false,
                              },
                              barPercentage: 0.4
                          }
                      ]
                  },
                  legend: {
                      display: false
                  },
                  tooltips: {
                      callbacks: {
                          label: function (tooltipItem, data) {
                              var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                              return datasetLabel + ': ' + tooltipItem.yLabel;
                          }
                      }
                  },
                  hover: {
                      animationDuration: 0
                  },
                  animation: {
                      onComplete: function () {
                          var chartInstance = this.chart;
                          var ctx = chartInstance.ctx;
                          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                          ctx.fillStyle = "#686868";
                          ctx.textAlign = 'center';
                          ctx.textBaseline = 'bottom';

                          this.data.datasets.forEach(function (dataset, i) {
                              var meta = chartInstance.controller.getDatasetMeta(i);
                              meta.data.forEach(function (bar, index) {
                                  var data = dataset.data[index];
                                  ctx.fillText(data, bar._model.x, bar._model.y - 5);
                              });
                          });
                      }
                  }
              }
          });
          document.getElementById('votes-chart-legend').innerHTML = votesChart.generateLegend();

          setInterval(() => {
          $.ajax({
              type: 'GET',
              url: '/admins/status-data',
              success: function (response) {

                  candidates = []
                  votes = []

                  response.barChartData.forEach(function(data){
                      candidates.push(data[0]);
                      votes.push(data[1]);
                  })

                  votesChart.data.labels = candidates
                  votesChart.data.datasets[0].data = votes

                  response.candidats.forEach(function(candidat) {
                    let ttvEl = document.querySelector('#totalVotes-'+candidat.id)
                    ttvEl.innerHTML = candidat.totalVotes

                    document.querySelector('#pourcentage-'+candidat.id).innerHTML = candidat.percentageVotes

                    if (candidat.nom == "VOTE NUL"){
                      document.querySelector('#btnVoteNul').innerHTML = candidat.totalVotes
                    }

                    
                  })
                  document.querySelector('#btnTotal').innerHTML =response.totalVotes

                  votesChart.update()


              },
              error: function (error) {
                  console.log(error);
              }
          });
        }, 2000);
        }


        
    });
</script>
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
                            text.push('<label class="badge badge-light badge-pill legend-percentage ml-auto">' + chart.data.datasets[0].data[i] + '%</label>');
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

  @endsection
