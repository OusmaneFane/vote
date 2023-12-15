<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/layout/horizontal-menu.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:05:55 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Melody Admin</title>
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
  <link rel="shortcut icon" href="/new-template/images/favicon.png" />
</head>
<body class="horizontal-menu">
  <div class="container-scroller">
    <nav class="navbar horizontal-layout-navbar fixed-top navbar-expand-lg">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="/new-template/index-2.html"><img src="/new-template/images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="/new-template/index-2.html"><img src="/new-template/images/logo-mini.svg" alt="logo"/></a>                    
      </div>
      <div class="navbar-menu-wrapper d-flex flex-grow">
        <ul class="navbar-nav navbar-nav-left collapse navbar-collapse" id="horizontal-top-example">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="projects-dropdown" data-toggle="dropdown" aria-expanded="false">
              Tableau de bord
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="projects-dropdown">
              <a class="dropdown-item" href="{{route('dashboard')}}">
                <i class="mdi mdi-laptop-mac mr-2 text-primary"></i>
                Tableau de bord
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-database mr-2 text-primary"></i>
                Big data
              </a>
              <div class="dropdown-divider"></div>                
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-cellphone-android mr-2 text-primary"></i>
                Mobile App
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="employees-dropdown" data-toggle="dropdown" aria-expanded="false">
              Employees
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="employees-dropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-monitor-multiple mr-2 text-primary"></i>
                Developers
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-scale-balance mr-2 text-primary"></i>
                Testers
              </a>
              <div class="dropdown-divider"></div>                
              <a class="dropdown-item" href="#">
                <i class="fa fa-user mr-2 text-primary"></i>
                Managers
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="actions-dropdown" data-toggle="dropdown" aria-expanded="false">
              Events
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="actions-dropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-launch mr-2 text-primary"></i>
                App Launch
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="fa fa-user-multiple-outline mr-2 text-primary"></i>
                Board Meeting
              </a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile">
            <a class="nav-link">
              <div class="nav-profile-text">
                Jane Robert
              </div>
              <div class="nav-profile-img">
                <img src="/new-template/images/faces/face5.jpg" alt="image" class="img-xs rounded-circle ml-3">
                <span class="availability-status online"></span>             
              </div>
            </a>
          </li>
          <li class="nav-item nav-search">
            <div class="nav-link">
              <div class="search-field d-none d-md-block">
                <form class="d-flex align-items-stretch h-100" action="#">
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-search"></i>                                          
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search your projects ...">
                  </div>
                </form>
              </div>
            </div>
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
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
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
