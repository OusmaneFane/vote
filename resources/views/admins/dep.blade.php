@extends('admins.dashboard')

@section("content")
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="{{ url('designsform/defaut.css') }}">

<style>
    .image-ronde{
      width : 150px; height : 150px;
      border: none;
      -moz-border-radius : 75px;
      -webkit-border-radius : 75px;
      border-radius : 75px;
    }
    </style>

</div>




<!--custom chart end-->


<div class="row">
    <div class="results">
        @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
        @endif
    </div>
        <div class="results">
            @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
             @endif
       </div>

       <div class="row mt  ">
       <div class="col-md-3 col-sm-4 mb">
        <div class="grey-panel pn donut-chart">
          <div class="grey-header">
            <h5>Demba TOUNKARA</h5>
          </div>
          <canvas id="serverstatus01" height="120" width="120"></canvas>
          <script>
            var doughnutData = [{
                value: {{ $demba }},
                color: "green"
              },
              {
                value: 300,
                color: "#fdfdfd"
              }
            ];
            var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
          </script>
          <div class="row">
            <div class="col-sm-6 col-xs-6 goleft">
              <p>Nombre de<br/>Votes:</p>
            </div>
            <div class="col-sm-6 col-xs-6">
              <h2>{{ $demba  }}  </h2>
            </div>
          </div>
        </div>
        <!-- /grey-panel -->
      </div>

      <div class="col-md-3 col-sm-4 mb">
        <div class="grey-panel pn donut-chart">
            <div class="grey-header">
              <h5>Abdoul Kader DOUCOURE </h5>
            </div>
            <canvas id="serverstatus05" height="120" width="120"></canvas>
            <script>
              var doughnutData = [{
                  value: {{ $kader }},
                  color: "blue"
                },
                {
                  value: 300,
                  color: "#fdfdfd"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus05").getContext("2d")).Doughnut(doughnutData);
            </script>
            <div class="row">
              <div class="col-sm-6 col-xs-6 goleft">
                <p>Nombre de<br/>Votes:</p>
              </div>
              <div class="col-sm-6 col-xs-6">
                <h2>{{ $kader  }}  </h2>
              </div>
            </div>
          </div>
        <!-- /panel -->
      </div>
      <div class="col-md-3 col-sm-4 mb">
        <div class="grey-panel pn donut-chart">
            <div class="grey-header">
              <h5>Abibatou TRAORE</h5>
            </div>
            <canvas id="serverstatus02" height="120" width="120"></canvas>
            <script>
              var doughnutData = [{
                  value: {{ $abibatou }},
                  color: "yellow"
                },
                {
                  value: 300,
                  color: "#fdfdfd"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
            </script>
            <div class="row">
              <div class="col-sm-6 col-xs-6 goleft">
                <p class="info">Nombre de<br/>Votes:</p>
              </div>
              <div class="col-sm-6 col-xs-6">
                <h2>{{ $abibatou  }}  </h2>
              </div>
            </div>
          </div>
        <!--  /darkblue panel -->
      </div>
      <div class="col-md-3 col-sm-4 mb">
        <div class="grey-panel pn donut-chart">
            <div class="grey-header">
              <h5>VOTE NUL</h5>
            </div>
            <canvas id="serverstatus08" height="120" width="120"></canvas>
            <script>
              var doughnutData = [{
                  value: {{ $vote_nul }},
                  color: "black"
                },
                {
                  value: 300,
                  color: "#fdfdfd"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus08").getContext("2d")).Doughnut(doughnutData);
            </script>



            <div class="row">
              <div class="col-sm-6 col-xs-6 goleft">
                <p>Nombre de<br/>Votes:</p>
              </div>
              <div class="col-sm-6 col-xs-6">
                <h2>{{ $vote_nul  }}  </h2>
              </div>
            </div>
          </div>
      </div>
       </div>



    @foreach ($candidats as  $candidat)
    <div class="dep">
        <h5 class="rounded-5 p-2 mb-2 bg-secondary text-center text-white">{{ $candidat['nom'] }}</h5>
        <div class="text-center">

        <img class="image-ronde" src="/{{ $candidat['photo']  }}" alt="" ><br>
           <a href="?filtre={{ $candidat['nom'] }}" class="btn btn-success btn-lg  gap-2 col-3 mx-auto mt-2 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
          </svg></a>
           <a href="?delete={{ $candidat['id'] }}" class="danger"><button class="btn btn-danger btn-lg  gap-2 col-3 mx-auto mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-dash" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
          </svg></button></a><br>
        </div>
    </div>

    @endforeach
  <!-- /col-md-4 -->
</div>
<!-- /row -->
</div>
<!-- /col-lg-9 END SECTION MIDDLE -->
<!-- **********************************************************************************************************************************************************
  RIGHT SIDEBAR CONTENT
  *********************************************************************************************************************************************************** -->
<div class="col-lg-3 ds">
<!--COMPLETED ACTIONS DONUTS CHART-->
<div class="donut-main">
  <h4>Nombre total de vote : {{ $som+$vote_nul}}</h4>
  <canvas id="newchart" height="130" width="130"></canvas>
  <script>
    var doughnutData = [{
        value: {{ $som }},
        color: "red"
      },
      {
        value: 1000,
        color: "#fdfdfd"
      }
    ];
    var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
  </script>
</div>
<!--NEW EARNING STATS -->
<div class="panel terques-chart">
  <div class="panel-body">
    <div class="chart">
      <div class="centered">
        <span>Enregistré :</span>
        <strong>{{ $som }}</strong>
      </div>
      <div class="centered">
        <span>Vote nul : </span>
        <strong>{{ $vote_nul}}</strong>
      </div>
      <br>
      <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
    </div>
  </div>
</div>
<!--new earning end-->
<!-- RECENT ACTIVITIES SECTION -->
{{-- <h4 class="centered mt">RECENT ACTIVITY</h4> --}}
<!-- First Activity -->
{{-- <div class="desc">
  <div class="thumb">
    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
  </div>
  <div class="details">
    <p>
      <muted>Just Now</muted>
      <br/>
      <a href="#">Paul Rudd</a> purchased an item.<br/>
    </p>
  </div>
</div> --}}
<!-- Second Activity -->
{{-- <div class="desc">
  <div class="thumb">
    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
  </div>
  <div class="details">
    <p>
      <muted>2 Minutes Ago</muted>
      <br/>
      <a href="#">James Brown</a> subscribed to your newsletter.<br/>
    </p>
  </div>
</div> --}}
<!-- Third Activity -->
{{-- <div class="desc">
  <div class="thumb">
    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
  </div>
  <div class="details">
    <p>
      <muted>3 Hours Ago</muted>
      <br/>
      <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
    </p>
  </div>
</div> --}}
<!-- Fourth Activity -->
{{-- <div class="desc">
  <div class="thumb">
    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
  </div>
  <div class="details">
    <p>
      <muted>7 Hours Ago</muted>
      <br/>
      <a href="#">Brando Page</a> purchased a year subscription.<br/>
    </p>
  </div>
</div> --}}
<!-- USERS ONLINE SECTION -->
{{-- <h4 class="centered mt">TEAM MEMBERS ONLINE</h4> --}}
<!-- First Member -->
{{-- <div class="desc">
  <div class="thumb">
    <img class="img-circle" src="/temps/img/ui-divya.jpg" width="35px" height="35px" align="">
  </div>
  <div class="details">
    <p>
      <a href="#">DIVYA MANIAN</a><br/>
      <muted>Available</muted>
    </p>
  </div>
</div> --}}
<!-- Second Member -->
{{-- <div class="desc">
  <div class="thumb">
    <img class="img-circle" src="/temps/img/ui-sherman.jpg" width="35px" height="35px" align="">
  </div>
  <div class="details">
    <p>
      <a href="#">DJ SHERMAN</a><br/>
      <muted>I am Busy</muted>
    </p>
  </div>
</div> --}}
<!-- Third Member -->
{{-- <div class="desc">
  <div class="thumb">
    <img class="img-circle" src="/temps/img/ui-danro.jpg" width="35px" height="35px" align="">
  </div>
  <div class="details">
    <p>
      <a href="#">DAN ROGERS</a><br/>
      <muted>Available</muted>
    </p>
  </div>
</div> --}}
<!-- Fourth Member -->
{{-- <div class="desc">
  <div class="thumb">
    <img class="img-circle" src="/temps/img/ui-zac.jpg" width="35px" height="35px" align="">
  </div>
  <div class="details">
    <p>
      <a href="#">Zac Sniders</a><br/>
      <muted>Available</muted>
    </p>
  </div>
</div> --}}
<!-- CALENDAR-->
<div id="calendar" class="mb">
  <div class="panel green-panel no-margin">
    <div class="panel-body">
      <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
        <div class="arrow"></div>
        <h3 class="popover-title" style="disadding: none;"></h3>
        <div id="date-popover-content" class="popover-content"></div>
      </div>
      <div id="my-calendar"></div>
    </div>
  </div>

</div>
@endsection
