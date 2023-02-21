<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  <title>Sup | E-vote</title>

  <!-- Favicons -->
  <link href="{{ url('picturesform/sup.jpg') }}" rel="icon">
  <link href="{{ url('picturesform/sup.jpg') }}" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="{{ url('temps/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!--external css-->
  <link href="{{ url('temps/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ url('temps/css/zabuto_calendar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('temps/lib/gritter/css/jquery.gritter.css') }}" />
  <!-- Custom styles for this template -->
  <link href="{{ url('temps/css/style.css') }}" rel="stylesheet">
  <link href="{{ url('temps/css/style-responsive.css') }}" rel="stylesheet">
  <script src="{{ url('temps/lib/chart-master/Chart.js') }}"></script>
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="/lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="/lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="/lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/style-responsive.css" rel="stylesheet">
  <script src="/lib/chart-master/Chart.js"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
       <a href="/admins/dashboard" class="logo"><b>SUP<span>'MANAGEMENT</span></b></a>
      <!--logo end-->


      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="/logout">Logout</a></li>
        </ul>
      </div>
    </header>

    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="/picturesform/sup.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">{{ $actel_user->name }}</h5>

            {{-- dashboard --}}

            <li class="sub-menu">
                <a href="/admins/dashboard" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                    </a>
            </li>
          <li class="sub-menu">
            <a href="/posts/inscrit" class="{{ request()->routeIs('add_student') ? 'active' : '' }}">
              <i class="fa fa-desktop"></i>
              <span>ADD a Student</span>
              </a>

          </li>
          <li class="sub-menu active">
            <a href="/admins/dep" class="{{ request()->routeIs('depouillement') ? 'active' : '' }}" >
              <i class="fa fa-cogs"></i>
              <span>Décompte</span>
              </a>

          </li>
          <li class="sub-menu">
            <a href="/admins/final_results" class="{{ request()->routeIs('re_final') ? 'active' : '' }}">
              <i class="fa fa-desktop"></i>
              <span>Resultat final</span>
              </a>

          </li><br>
        {{-- create candidat --}}
        <span style="color: orange">Candidats</span>
          <li class="sub-menu">
            <a href="/create_candidat" class="{{ request()->routeIs('candidats.create') ? 'active' : '' }}">
              <i class="fa fa-plus"></i>
              <span>ADD a Candidat</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="/edit_candidat" class="{{ request()->routeIs('candidats.edit_candidat') ? 'active' : '' }}">
                <i class="fa fa-edit"></i>
                <span>EDIT a Candidat</span>
                </a>
            </a>
          </li>


          <p  style="color: orange">Décompte</p>
          <li class="sub-menu">
            <a class="{{ request()->routeIs('re_dep') ? 'active' : '' }}" href="/admins/dep_results">
              <i class="fa fa-dashboard"></i>
              <span>Resultats des decomptes </span>
              </a>
          </li>

          <p  style="color: orange">En ligne</p>
          <li class="sub-menu">
            <a class="{{ request()->routeIs('re_online') ? 'active' : '' }}" href="/admins/statut">
              <i class="fa fa-dashboard"></i>
              <span>Resultats des votes en ligne</span>
              </a>
          </li>


          {{-- <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Data Tables</span>
              </a>
            <ul class="sub">
              <li><a href="basic_table.html">Basic Table</a></li>
              <li><a href="responsive_table.html">Responsive Table</a></li>
              <li><a href="advanced_table.html">Advanced Table</a></li>
            </ul>
          </li> --}}
          {{-- <li>
            <a href="inbox.html">
              <i class="fa fa-envelope"></i>
              <span>Mail </span>
              <span class="label label-theme pull-right mail-info">2</span>
              </a>
          </li> --}}
          {{-- <li class="sub-menu">
            <a href="javascript:;">
              <i class=" fa fa-bar-chart-o"></i>
              <span>Charts</span>
              </a>
            <ul class="sub">
              <li><a href="morris.html">Morris</a></li>
              <li><a href="chartjs.html">Chartjs</a></li>
              <li><a href="flot_chart.html">Flot Charts</a></li>
              <li><a href="xchart.html">xChart</a></li>
            </ul>
          </li> --}}
          {{-- <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-comments-o"></i>
              <span>Chat Room</span>
              </a>
            <ul class="sub">
              <li><a href="lobby.html">Lobby</a></li>
              <li><a href="chat_room.html"> Chat Room</a></li>
            </ul>
          </li> --}}
          {{-- <li>
            <a href="google_maps.html">
              <i class="fa fa-map-marker"></i>
              <span>Google Maps </span>
              </a>
          </li> --}}
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->

    <section id="main-content">

      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
                 @yield('content')

            </div>
            <!-- / calendar -->
          </div>
          <!-- /col-lg-3 -->
        </div>
        <!-- /row -->
      </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        @yield("compt")
        <p>
          &copy; Copyrights <strong>Sup'Management</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          {{-- Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a> --}}
        </div>
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="/temps/lib/jquery/jquery.min.js"></script>


  <script src="/temps/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="/temps/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="/temps/lib/jquery.scrollTo.min.js"></script>
  <script src="/temps/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="/temps/lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="/temps/lib/common-scripts.js"></script>
  <script type="text/javascript" src="/temps/lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="/temps/lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="/temps/lib/sparkline-chart.js"></script>
  <script src="/temps/lib/zabuto_calendar.js"></script>
  {{-- <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Dashio!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
        // (string | optional) the image to display on the left
        image: 'img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script> --}}
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="/lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="/lib/advanced-datatable/js/jquery.js"></script>
  <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="/lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="/lib/jquery.scrollTo.min.js"></script>
  <script src="/lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="/lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="/lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "/lib/advanced-datatable/media/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "/lib/advanced-datatable/images/details_close.png";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });
  </script>
</body>

</html>
