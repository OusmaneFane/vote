<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sup | E-vote</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('picturesform/sup.jpg') }}" rel="icon">
  <link href="{{ url('picturesform/sup.jpg') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('formulaire/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('formulaire/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ url('formulaire/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{ url('formulaire/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ url('formulaire/assets/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('formulaire/assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PhotoFolio - v1.1.1
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <div href="index.html" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <i><img src="/picturesform/supmanagement.png" alt=""></i>
        <h1>Sup'Management</h1>
      </div>

      {{-- <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li class="dropdown"><a href="#"><span>Gallery</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="gallery.html">Nature</a></li>
              <li><a href="gallery.html">People</a></li>
              <li><a href="gallery.html">Architecture</a></li>
              <li><a href="gallery.html">Animals</a></li>
              <li><a href="gallery.html">Sports</a></li>
              <li><a href="gallery.html">Travel</a></li>
              <li class="dropdown"><a href="#"><span>Sub Menu</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Sub Menu 1</a></li>
                  <li><a href="#">Sub Menu 2</a></li>
                  <li><a href="#">Sub Menu 3</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="services.html">Services</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav><!-- .navbar --> --}}
      <style>
        @font-face {
  font-family: "Grotesque";
  src: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/397014/BrandonGrotesque-Regular.eot"), url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/397014/BrandonGrotesque-Regular.ttf"), url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/397014/BrandonGrotesque-Regular.woff");
  font-weight: normal;
}
@font-face {
  font-family: "Grotesque Black";
  src: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/397014/BrandonGrotesque-Black.eot"), url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/397014/BrandonGrotesque-Black.ttf"), url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/397014/BrandonGrotesque-Black.woff");
  font-weight: bold;
}

form .content{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin: auto;
}
* {
  box-sizing: border-box;
}
html, body {
  font-size: 100%;
}
body {
  padding: 0;
  margin: 0;
  background: #152536;
}
a[href] {
  position: relative;
}
a[href], a[href]:link, a[href]:visited, a[href]:active {
  text-decoration: none;
  color: #d8276c;
  text-shadow: 2px 2px 2px #070c11;
  padding-bottom: 3px;
  font-weight: bold;
}
a[href]::after {
  content: "";
  position: absolute;
  left: 0;
  left: 0;
  bottom: 0;
  background: #fff;
  width: 0;
  height: 1px;
  transition: 0.35s cubic-bezier(0.17, 0.67, 0.5, 1.03);
}
a[href]:hover::after {
  width: 100%;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
}
.note {
  color: #fff;
  font-size: 1rem;
  font-family: 'Merriweather', sans-serif;
  line-height: 1.5;
  text-align: center;

	display: flex;
	justify-content: center;
	align-items: center;
}
article.card {
  width: 350px;
  height: 370px;
  border-radius: 3px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
  overflow: hidden;
  margin: 8px;
  display: block;
}
article.card .thumb {
  width: auto;
  height: 260px;
  /* background: url("https://i.ibb.co/F7xw8SK/junior.jpg") no-repeat center; */
  background-size: cover;
  border-radius: 3px;
}
article.card .infos {
  width: auto;
  height: 370px;
  position: relative;
  padding: 14px 24px;
  background: #fff;
	transition: 0.3s;
}
article.card .infos .title {
  position: relative;
  margin: 10px 0;
  letter-spacing: 3px;
  color: #152536;
  font-family: 'Grotesque Black', sans-serif;
  font-size: 1rem;
  text-transform: uppercase;
  text-shadow: 0 0 0px #32577f;
}
article.card .infos .date, article.card .infos .seats {
  margin-bottom: 10px;
  text-transform: uppercase;
  font-size: 0.85rem;
  color: rgba(21, 37, 54, 0.7);
  font-family: 'Grotesque', sans-serif;
}
article.card .infos .seats {
  display: inline-block;
  margin-bottom: 24px;
  padding-bottom: 24px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.2);
}
article.card .infos .txt {
  font-family: 'Merriweather', sans-serif;
  line-height: 2;
  font-size: 0.95rem;
  color: rgba(21, 37, 54, 0.7);
}
article.card .infos .details {
  position: absolute;
  left: 0;
  left: 0;
  bottom: 0;
  margin: 10px 0;
  padding: 20px 24px;
  letter-spacing: 1px;
  color: #4e958b;
  font-family: 'Grotesque Black', sans-serif;
  font-size: 0.9rem;
  text-transform: uppercase;
  cursor: pointer;
}
.infos.opened {
  transform: translateY(-260px);
}

.btnDesc{
	border: 1px solid #101010;
	border-raduis: 4px;
	margin-bottom: 8px;
}
.voteGreen{
	fill: current-color;
	color: green;
}
      </style>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center" >
          <h2 >Le moment tant attendu est <span>enfin arrivé</span></h2>
          <h2 >Celui de choisir un président au poste de LEADER MANAGER.</h2>
          <p  class="btn-get-started">Bienvenue {{ $actel_user->matricule }}</p>
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>

        @endif

<form method="post" action="/posts/validate">
@csrf
<div class="content">
@foreach ($candidats as  $candidat)

        <div class="note">
            <article class="card" >
            <input type="radio" name="candidat_id" class='radioChoice' hidden value="{{ $candidat['id'] }}">
            <div class="thumb" stype="postion: relative">
            <img class="btnImgCan" src="/storage/candidats/{{ $candidat['photo']  }}" style="position: absolute; height: 100%;width: 100%;left:0; top:0;" />

            </div>

            <div class="infos">
                <h2 class="title candidant_nom" style="display: flex; justify-content: space-between;">{{ $candidat['nom']  }}
                    <button type="button" class="btnVote">
                        <svg  style="margin-left: auto" width="40" height="32" viewBox="0 0 640 512"><path fill="currentColor" d="M608 320h-64v64h22.4c5.3 0 9.6 3.6 9.6 8v16c0 4.4-4.3 8-9.6 8H73.6c-5.3 0-9.6-3.6-9.6-8v-16c0-4.4 4.3-8 9.6-8H96v-64H32c-17.7 0-32 14.3-32 32v96c0 17.7 14.3 32 32 32h576c17.7 0 32-14.3 32-32v-96c0-17.7-14.3-32-32-32zm-96 64V64.3c0-17.9-14.5-32.3-32.3-32.3H160.4C142.5 32 128 46.5 128 64.3V384h384zM211.2 202l25.5-25.3c4.2-4.2 11-4.2 15.2.1l41.3 41.6l95.2-94.4c4.2-4.2 11-4.2 15.2.1l25.3 25.5c4.2 4.2 4.2 11-.1 15.2L300.5 292c-4.2 4.2-11 4.2-15.2-.1l-74.1-74.7c-4.3-4.2-4.2-11 0-15.2z"/></svg>
                    </button>

                    </h2>

                <button type="button" class="date btnDesc">Slogan</button>
                <p class="txt" style="color: orange"><b>{{ $candidat['slogan']  }}</b></p>
                <h3 class="details btnTextVote">Choisir</h3>
            </div>
        </article>
        </div>
@endforeach
</div>
<br>
  <div class="text-center">
   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >Valider votre vote</button>
  </div>





    </section><!-- End Gallery Section -->

  </main><!-- End #main -->
<!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 bg-danger" id="exampleModalLabel">Attention !!!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Voulez-vous vraiment voter pour <span id="candidant_choisi"></span> ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Oui</button>
        </div>
      </div>
    </div>
  </div>
</form>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>2022 Sup'Management </span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>
  </footer><!-- End Footer -->


  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="/formulaire/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/formulaire/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/formulaire/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/formulaire/assets/vendor/aos/aos.js"></script>
  <script src="/formulaire/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/formulaire/assets/js/main.js"></script>
  <script>
    var btns = document.querySelectorAll('.btnDesc')

var infos = document.querySelectorAll('.infos')

btns.forEach( function(btn, i){
	var info = infos[i]
	btn.addEventListener("click", function(){



	if (info.classList.contains('opened')) {
		btn.innerHTML= "Details campagne"
		info.classList.remove('opened')
										   }
	else {
		info.classList.add('opened')
		btn.innerHTML= "Réduire"
	}
	})

} )



var candidant_choisi = document.querySelector('#candidant_choisi')
var candidant_noms = document.querySelectorAll('.candidant_nom')
var btnImgCans = document.querySelectorAll('.btnImgCan')

var btnTextVotes = document.querySelectorAll('.btnTextVote')
var radios = document.querySelectorAll('.radioChoice')
var btnVotes = document.querySelectorAll('.btnVote')
var voteIcons = document.querySelectorAll('.btnVote svg')



btnVotes.forEach( function(btnVote, index){
	var voteIcon = voteIcons[index]
	btnVote.addEventListener("click", function(e){
    e.preventDefault()
    radios.forEach( function(radio){
      radio.checked = false
		} )
		voteIcons.forEach( function(voteIcon){
			voteIcon.classList.remove('voteGreen')
		} )
		if (voteIcon.classList.contains('voteGreen')) {
      voteIcon.classList.remove('voteGreen')
      candidant_choisi.innerHTML = ''

      radios[index].checked = false
    }
		else {
      voteIcon.classList.add('voteGreen')
      radios[index].checked = true
      candidant_choisi.innerHTML = candidant_noms[index].textContent
     }
	})
} )

btnTextVotes.forEach( function(btnVote, index){
	var voteIcon = voteIcons[index]
	btnVote.addEventListener("click", function(e){
    e.preventDefault()
    radios.forEach( function(radio){
      radio.checked = false
		} )
		voteIcons.forEach( function(voteIcon){
			voteIcon.classList.remove('voteGreen')
		} )
		if (voteIcon.classList.contains('voteGreen')) {
      voteIcon.classList.remove('voteGreen') ;
      radios[index].checked = false
      candidant_choisi.innerHTML = ''
    }
		else {
      voteIcon.classList.add('voteGreen');
      radios[index].checked = true
      candidant_choisi.innerHTML = candidant_noms[index].textContent
    }
	})
} )
btnImgCans.forEach( function(btnVote, index){
	var voteIcon = voteIcons[index]
	btnVote.addEventListener("click", function(e){

    e.preventDefault()
    radios.forEach( function(radio){
      radio.checked = false
		} )
		voteIcons.forEach( function(voteIcon){
			voteIcon.classList.remove('voteGreen')
		} )
		if (voteIcon.classList.contains('voteGreen')) {voteIcon.classList.remove('voteGreen'); radios[index].checked = false; candidant_choisi.innerHTML = '';}
		else {voteIcon.classList.add('voteGreen'); radios[index].checked = true
      candidant_choisi.innerHTML = candidant_noms[index].textContent
    }
	})
} )


  </script>


</body>

</html>
