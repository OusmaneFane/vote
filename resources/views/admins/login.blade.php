

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
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

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <h4 class="text-center">ADMIN</h4>
        <h2 style=" font-family: 'ADlaMDisplay', sans-serif;"><span style=" font-family: 'ADlaMDisplay', sans-serif;"
              class="text-warning">Sup-</span><span class="text-primary">Vote</span></h2>
              </div>
              <div class="results">
                                    @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        <h4>{{ Session::get('fail') }}</h4>
                                    </div>
                                    @endif
                                </div>
              <h6 class="font-weight-light">Connectez-vous pour continuer.</h6>
              <form class="pt-3" method="post" action="/admins/check">
                @csrf
                <div class="form-group">
                  <input type="text" name="name" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Nom">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mot de passe">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >CONNEXION</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/new-template/vendors/js/vendor.bundle.base.js"></script>
  <script src="/new-template/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/new-template/js/off-canvas.js"></script>
  <script src="/new-template/js/hoverable-collapse.js"></script>
  <script src="/new-template/js/misc.js"></script>
  <script src="/new-template/js/settings.js"></script>
  <script src="/new-template/js/todolist.js"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
</html>
