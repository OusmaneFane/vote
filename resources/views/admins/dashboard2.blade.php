<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sup'Vote</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/new-template/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="/new-template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/new-template/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/new-template/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/new-template/images/sup.jpeg" />
</head>
<body class="horizontal-menu">
  <div class="container-scroller">
    <nav class="navbar horizontal-layout-navbar fixed-top navbar-expand-lg">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <h2 style=" font-family: 'ADlaMDisplay', sans-serif;"><span style=" font-family: 'ADlaMDisplay', sans-serif;"
              class="text-warning">Sup-</span><span class="text-white">Vote</span></h2>
      </div>
      <div class="navbar-menu-wrapper d-flex flex-grow">
        <ul class="navbar-nav navbar-nav-left collapse navbar-collapse " id="horizontal-top-example">
          <li class="nav-item dropdown ml-4">
            <a class="nav-link dropdown-toggle active text-white" href="#" id="projects-dropdown" data-toggle="dropdown" aria-expanded="false">
              Acceuil
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="projects-dropdown">
              <a class="dropdown-item " href="{{route('dashboard')}}">
                <i class="mdi mdi-laptop-mac mr-2 text-primary"></i>
                Tableau de bord
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-database mr-2 text-primary"></i>
               Ajouter un étudiant
              </a>
              <div class="dropdown-divider"></div>                
              
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="employees-dropdown" data-toggle="dropdown" aria-expanded="false">
              Décomptes
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="employees-dropdown">
              <a class="dropdown-item" href="{{route('depouillement')}}">
                <i class="fa fa-user mr-2 text-primary"></i>
                faire un décompte
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('re_dep')}}">
                <i class="mdi mdi-scale-balance mr-2 text-primary"></i>
                Resultat des décomptes
              </a>
              <div class="dropdown-divider"></div>                
             
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="actions-dropdown" data-toggle="dropdown" aria-expanded="false">
              Résultats
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="actions-dropdown">
              <a class="dropdown-item" href="{{route('re_dep')}}">
                <i class="mdi mdi-launch mr-2 text-primary"></i>
                Résultats des décomptes
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('re_online')}}">
                <i class="fa fa-user-multiple-outline mr-2 text-primary"></i>
                Résultats des votes en ligne
              </a>
              <a class="dropdown-item" href="{{route('re_final')}}">
                <i class="fa fa-user-multiple-outline mr-2 text-primary"></i>
                Résultats finaux 
              </a>
            </div>
          </li>
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="actions-dropdown" data-toggle="dropdown" aria-expanded="false">
              Candidats
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="actions-dropdown">
              <a class="dropdown-item" href="{{route('candidats.create')}}">
                 <i class="fa fa-user mr-2 text-primary"></i>
                Ajouter
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('candidats.edit_candidat')}}">
                <i class="fa fa-user-multiple-outline mr-2 text-primary"></i>
               Liste
              </a>
              
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="actions-dropdown" data-toggle="dropdown" aria-expanded="false">
              Etudiant
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="actions-dropdown">
              <a class="dropdown-item" href="{{route('add_student')}}">
                 <i class="fa fa-user mr-2 text-primary"></i>
                Ajouter
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/import_file">
                <i class="fa fa-user-multiple-outline mr-2 text-primary"></i>
               Importer
              </a>
              
            </div>
          </li>
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="actions-dropdown" data-toggle="dropdown" aria-expanded="false">
              Classes
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="actions-dropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/import_classes">
                <i class="fa fa-user-multiple-outline mr-2 text-primary"></i>
               Importer
              </a>
              
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile">
            <a class="nav-link">
              <div class="nav-profile-text">
                {{$actel_user->name}}
              </div>
              <div class="nav-profile-img">
                <img src="/new-template/images/sup.jpeg" alt="image" class="img-xs rounded-circle ml-3">
                <span class="availability-status online"></span>             
              </div>
            </a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link">
              <i class="fas fa-power-off font-weight-bold icon-sm"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button" data-toggle="collapse" data-target="#horizontal-top-example">
          <span class="fa fa-bars"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:/new-template/partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.supmanagement.ml/" target="_blank">Sup'Management</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sup'Management - MALI  <i class="far fa-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="/new-template/vendors/js/vendor.bundle.base.js"></script>
  <script src="/new-template/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/new-template/js/off-canvas.js"></script>
  <script src="/new-template/js/hoverable-collapse.js"></script>
  <script src="/new-template/js/misc.js"></script>
  <script src="/new-template/js/settings.js"></script>
  <script src="/new-template/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/new-template/js/dashboard.js"></script>
  <!-- End custom js for this page-->
    <script src="/new-template/js/flot-chart.js"></script>

</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
</html>
