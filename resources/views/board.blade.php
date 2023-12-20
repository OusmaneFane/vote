

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sup'Vote Login</title>
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

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
               <div class="d-flex justify-content-between">
                  <h5>Temps restant</h5>
                  </b><button style="margin-top:-10px" id="timer" class="btn btn-danger"></button></b>
                </div>
                <br>



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
                <div class="results">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        <h4>{{ Session::get('success') }}</h4>
                    </div>
                     @endif
               </div>
              <h6 class="font-weight-light">Merci de vous authentifier avant de voter !</h6>
              <form class="pt-3" method="post" action="/posts/check">
                @csrf
                <div class="form-group">
                  <label for="exampleInputName">Matricule</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" name="matricule" class="form-control form-control-lg border-left-0" id="exampleInputName" placeholder="950XXXX">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Mot de passe">                        
                  </div>
                </div>

                <div class="my-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">CONNEXION</button>
                </div>

              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2023  All rights reserved.</p>
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
<script>
    function updateTimer() {
        // Récupérer la date actuelle
        var currentTime = new Date();

        // Définir la date de début du minuteur (demain à 10h)
        var startDate = new Date();
        startDate.setDate(currentTime.getDate() + 1); // Demain
        startDate.setHours(10, 0, 0, 0); // 10h00 demain

        // Définir la date de fin du minuteur (21 décembre du mois actuel)
        var endDate = new Date(currentTime.getFullYear(), 11, 21, 23, 59, 59, 999); // Mois 11 = décembre

        // Calculer la différence entre la date de fin et la date actuelle
        var timeDifference = endDate - currentTime;

        // Convertir la différence en secondes
        var seconds = Math.floor(timeDifference / 1000);

        // Calculer les jours, heures, minutes et secondes
        var days = Math.floor(seconds / (24 * 60 * 60));
        var hours = Math.floor((seconds % (24 * 60 * 60)) / 3600);
        var minutes = Math.floor((seconds % 3600) / 60);
        seconds = seconds % 60;

        // Afficher le minuteur sur la page
        $('#timer').text(days + ' jours ' + hours + ' heures ' + minutes + ' min ' + seconds + ' s');
    }

    // Mettre à jour le minuteur toutes les secondes
    setInterval(updateTimer, 1000);

    // Appeler la fonction de mise à jour du minuteur au chargement de la page
    $(document).ready(function () {
        updateTimer();
    });
</script>




<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
</html>

