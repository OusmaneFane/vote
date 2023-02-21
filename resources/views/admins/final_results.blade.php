@extends('admins.dashboard')

@section("content")
<h3>Resultats finaux</h3>
</div>
<div class="custom-bar-chart">
  {{-- <ul class="y-axis">
    <li><span>10.000</span></li>
    <li><span>8.000</span></li>
    <li><span>6.000</span></li>
    <li><span>4.000</span></li>
    <li><span>2.000</span></li>
    <li><span>0</span></li>
  </ul> --}}
  <div class="bar">
    <div class="title"></b></div>
    <div class="value tooltips bg-slate-400" data-original-title="" data-toggle="tooltip" data-placement="top"></div>
  </div>
  <div class="bar">
    <div class="title"></b></div>
    <div class="value tooltips bg-slate-400" data-original-title="" data-toggle="tooltip" data-placement="top"></div>
  </div>

  <div class="bar">
    <div class="title"><b>Demba<br>TOUNKARA</b></div>
    <div class="value tooltips bg-slate-400" data-original-title="{{ $demba }}" data-toggle="tooltip" data-placement="top">{{ $demba2   }}</div>
  </div>
  <div class="bar ">
    <div class="title"><b>Kader<br>DOUCOURE</b></div>
    <div class="value tooltips" data-original-title="{{ $kader  }}" data-toggle="tooltip" data-placement="top">{{ $kader2  }}</div>
  </div>
  <div class="bar ">
    <div class="title"><b>Abibatou<br>TRAORE</b></div>
    <div class="value tooltips" data-original-title="{{ $abibatou  }}" data-toggle="tooltip" data-placement="top">{{ $abibatou2  }}</div>
  </div>



</div>
<!--custom chart end-->
<div class="row mt">
  <!-- SERVER STATUS PANELS -->
  <div class="col-md-4 col-sm-4 mb">
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
  <div class="col-lg-4 col-md-4 col-sm-4 mb">
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
  <!-- /col-md-4-->
  <div class="col-md-4 col-sm-4 mb">
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
  <!-- /col-md-4 -->
  {{-- <div class="col-md-4 col-sm-4 mb">
    <!-- REVENUE PANEL -->
    <div class="green-panel pn">
        <div class="grey-panel pn donut-chart">
            <div class="grey-header">
              <h5>Oumou</h5>
            </div>
            <canvas id="serverstatus03" height="120" width="120"></canvas>
            <script>
              var doughnutData = [{
                  value: {{ $oumou }},
                  color: "pink"
                },
                {
                  value: 50,
                  color: "#fdfdfd"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
            </script>
            <div class="row">
              <div class="col-sm-6 col-xs-6 goleft">
                <p>Nombre de<br/>Votes:</p>
              </div>
              <div class="col-sm-6 col-xs-6">
                <h2>{{ $oumou  }}  </h2>
              </div>
            </div>
          </div>
    </div>
  </div> --}}
  <!-- /col-md-4 -->

<!-- /row -->
{{-- <div class="row">
  <!-- WEATHER PANEL -->
  <div class="col-md-4 mb">
    <div class="weather pn">
      <i class="fa fa-cloud fa-4x"></i>
      <h2>11º C</h2>
      <h4>BUDAPEST</h4>
    </div>
  </div>
  <!-- /col-md-4-->
  <!-- DIRECT MESSAGE PANEL -->
  <div class="col-md-8 mb">
    <div class="message-p pn">
      <div class="message-header">
        <h5>DIRECT MESSAGE</h5>
      </div>
      <div class="row">
        <div class="col-md-3 centered hidden-sm hidden-xs">
          <img src="img/ui-danro.jpg" class="img-circle" width="65">
        </div>
        <div class="col-md-9">
          <p>
            <name>Dan Rogers</name>
            sent you a message.
          </p>
          <p class="small">3 hours ago</p>
          <p class="message">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
          <form class="form-inline" role="form">
            <div class="form-group">
              <input type="text" class="form-control" id="exampleInputText" placeholder="Reply Dan">
            </div>
            <button type="submit" class="btn btn-default">Send</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /Message Panel-->
  </div>
  <!-- /col-md-8  -->
</div> --}}
{{-- <div class="row">
  <!-- TWITTER PANEL -->
  <div class="col-md-4 mb">
    <div class="twitter-panel pn">
      <i class="fa fa-twitter fa-4x"></i>
      <p>Dashio is here! Take a look and enjoy this new Bootstrap Dashboard theme.</p>
      <p class="user">@Alvrz_is</p>
    </div>
  </div>
  <!-- /col-md-4 -->
  <div class="col-md-4 mb">
    <!-- WHITE PANEL - TOP USER -->
    <div class="white-panel pn">
      <div class="white-header">
        <h5>TOP USER</h5>
      </div>
      <p><img src="img/ui-zac.jpg" class="img-circle" width="50"></p>
      <p><b>Zac Snider</b></p>
      <div class="row">
        <div class="col-md-6">
          <p class="small mt">MEMBER SINCE</p>
          <p>2012</p>
        </div>
        <div class="col-md-6">
          <p class="small mt">TOTAL SPEND</p>
          <p>$ 47,60</p>
        </div>
      </div>
    </div>
  </div>
  <!-- /col-md-4 -->
  <div class="col-md-4 mb">
    <!-- INSTAGRAM PANEL -->
    <div class="instagram-panel pn">
      <i class="fa fa-instagram fa-4x"></i>
      <p>@THISISYOU<br/> 5 min. ago
      </p>
      <p><i class="fa fa-comment"></i> 18 | <i class="fa fa-heart"></i> 49</p>
    </div>
  </div>
  <!-- /col-md-4 -->
</div> --}}
<!-- /row -->

  {{-- <div class="col-lg-4 col-md-4 col-sm-4 mb">
    <div class="grey-panel pn donut-chart">
        <div class="grey-header">
          <h5>Goundourou</h5>
        </div>
        <canvas id="serverstatus04" height="120" width="120"></canvas>
        <script>
          var doughnutData = [{
              value: {{ $abg }},
              color: "orange"
            },
            {
              value: 50,
              color: "#fdfdfd"
            }
          ];
          var myDoughnut = new Chart(document.getElementById("serverstatus04").getContext("2d")).Doughnut(doughnutData);
        </script>
        <div class="row">
          <div class="col-sm-6 col-xs-6 goleft">
            <p>Nombre de<br/>Votes:</p>
          </div>
          <div class="col-sm-6 col-xs-6">
            <h2>{{ $abg  }}  </h2>
          </div>
        </div>
      </div>
  </div> --}}
  <!-- /col-md-4 -->
  <!--  PROFILE 02 PANEL -->

  <!--/ col-md-4 -->
  {{-- <div class="col-md-4 col-sm-4 mb">
    <div class="grey-panel pn donut-chart">
        <div class="grey-header">
          <h5>Oumar</h5>
        </div>
        <canvas id="serverstatus06" height="120" width="120"></canvas>
        <script>
          var doughnutData = [{
              value: {{ $oumar }},
              color: "silver"
            },
            {
              value: 50,
              color: "#fdfdfd"
            }
          ];
          var myDoughnut = new Chart(document.getElementById("serverstatus06").getContext("2d")).Doughnut(doughnutData);
        </script>
        <div class="row">
          <div class="col-sm-6 col-xs-6 goleft">
            <p>Nombre de<br/>Votes:</p>
          </div>
          <div class="col-sm-6 col-xs-6">
            <h2>{{ $oumar  }}  </h2>
          </div>
        </div>
      </div>
  </div> --}}
  {{-- <div class="col-md-4 col-sm-4 mb">
    <div class="grey-panel pn donut-chart">
        <div class="grey-header">
          <h5>Diata</h5>
        </div>
        <canvas id="serverstatus07" height="120" width="120"></canvas>
        <script>
          var doughnutData = [{
              value: {{ $diata }},
              color: "#FF6B6B"
            },
            {
              value: 50,
              color: "#fdfdfd"
            }
          ];
          var myDoughnut = new Chart(document.getElementById("serverstatus07").getContext("2d")).Doughnut(doughnutData);
        </script>
        <div class="row">
          <div class="col-sm-6 col-xs-6 goleft">
            <p>Nombre de<br/>Votes:</p>
          </div>
          <div class="col-sm-6 col-xs-6">
            <h2>{{ $diata  }}  </h2>
          </div>
        </div>
      </div>
  </div> --}}
  <div class="col-md-4 col-sm-4 mb">
    <div class="darkblue-panel pn donut-chart">
        <div class="text-bg-dark p-3">
          <h5>VOTE NUL</h5>
        </div>
        <canvas id="serverstatus08" height="120" width="120"></canvas>
        <script>
          var doughnutData = [{
              value: {{ $vote_nul }},
              color: "black"
            },
            {
              value: 1000,
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
  <h4>Nombre total de vote : {{ $som+$vote_nul }}</h4>
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
        <strong>{{ $vote_nul }}</strong>
      </div>
      <br>
      <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
    </div>
  </div>
</div>
<!--new earning end-->
<!-- RECENT ACTIVITIES SECTION -->
<h4 class="centered mt">RECENT ACTIVITY</h4>
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
<h4 class="centered mt">TEAM MEMBERS ONLINE</h4>
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

@endsection
