<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sup'Vote</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

  <style>
    body {
      background: #f9fafb;
      font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
        "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    .voteGreen {
      color: #10b981;
    }
    .card {
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-4px) scale(1.02);
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    }
    .selected-card {
      border: 2px solid #10b981;
      box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
    }
    /* Bouton flottant */
    #floatingValidateBtn {
      position: fixed;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      z-index: 50;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <!-- Bouton flottant pour valider -->
  <button type="button" id="floatingValidateBtn" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition transform hover:scale-105 shadow-lg animate__animated animate__fadeInLeft">
    Valider votre vote
  </button>

  <!-- Header / Hero -->
  <header class="relative w-full h-56 bg-cover bg-center flex flex-col justify-center items-center" style="background-image: url('/new-template/images/cover.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 flex items-center space-x-2 mb-2">
      <img src="/new-template/images/sup.jpeg" alt="Logo" class="h-10 w-10 object-cover rounded"/>
      <h1 class="text-white text-lg font-bold tracking-wider text-center">ELECTION LEADER MANAGER 2024-2025</h1>
    </div>
    <div class="relative z-10 text-center text-white">
      <h5 class="text-yellow-400 text-sm">Bienvenue,</h5>
      <h2 class="text-white text-xl font-semibold">{{ $actel_user2['firstname'] }} {{ $actel_user2['lastname'] }} !</h2>
    </div>
  </header>

  <!-- Instructions -->
  <div class="mt-4 text-center px-4">
    <h1 class="text-xl font-bold text-gray-800 mb-2">Merci de choisir votre Candidat !</h1>
    @if(Session::get('fail'))
      <div class="text-red-600 font-semibold animate__animated animate__fadeInDown">{{ Session::get('fail') }}</div>
    @endif
  </div>

  <!-- Candidates Grid -->
  <form method="post" action="/posts/validate" class="flex-1 flex flex-col">
    @csrf
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-4 mt-4">
      @foreach ($candidats as $index => $candidat)
      <div class="relative bg-white rounded-lg shadow p-4 animate__animated animate__fadeInUp card group transition" data-index="{{ $index }}">
        <!-- Hidden radio -->
        <input type="radio" name="candidat_id" value="{{ $candidat['id'] }}" class="radioChoice hidden"/>

        <!-- Image du candidat, responsive: hauteur plus grande sur desktop -->
        <div  class="relative w-full h-64 md:h-80 bg-cover bg-center rounded-lg overflow-hidden btnImgCan shadow-md transition transform hover:scale-105" 
             style="background-image: url('/storage/candidats/{{ $candidat['photo'] }}'); cursor:pointer; height:30rem;">
          <!-- Bouton Vote -->
          <button type="button" class="btnVote absolute top-3 right-3 text-white bg-black bg-opacity-30 rounded-full p-1 hover:bg-green-500 transition transform hover:scale-110">
            <i class="fa fa-check-circle text-2xl"></i>
          </button>
        </div>

        <!-- Infos candidat -->
        <div class="mt-3 flex flex-col space-y-1">
          <h2 class="candidant_nom text-lg font-semibold text-gray-800 mt-2">{{ $candidat['nom'] }}</h2>
          <p class="text-sm text-gray-600 italic">{{ $candidat['slogan'] }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Modal de confirmation -->
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center hidden z-50">
      <div class="absolute inset-0 bg-black bg-opacity-50"></div>
      <div class="bg-white rounded-lg shadow-lg p-6 relative animate__animated animate__zoomIn w-80">
        <h1 class="text-lg font-bold text-gray-800 mb-4">Confirmation !!!</h1>
        <p class="text-gray-700 mb-6">Voulez-vous vraiment voter pour <span id="candidant_choisi" class="font-bold text-blue-600"></span> ?</p>
        <div class="flex justify-end space-x-2">
          <button type="button" id="closeModalBtn" class="px-4 py-2 rounded border border-gray-300 text-gray-600 hover:bg-gray-100">Annuler</button>
          <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Oui</button>
        </div>
      </div>
    </div>
  </form>

  <!-- Footer -->
  <footer class="text-center text-gray-500 text-sm py-4">
    &copy; 2024 <a href="https://supmanagement.ml" class="text-blue-600 hover:underline">Sup'Management</a>. Tous droits réservés.
  </footer>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    $(document).ready(function() {
      @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
      @endif

      @if (Session::has('fail'))
        toastr.error("{{ Session::get('fail') }}");
      @endif

      @if ($errors->any())
        @foreach ($errors->all() as $error)
          toastr.error("{{ $error }}");
        @endforeach
      @endif

      toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "2000",
      };

      var radios = document.querySelectorAll('.radioChoice');
      var btnVotes = document.querySelectorAll('.btnVote');
      var candidateNames = document.querySelectorAll('.candidant_nom');
      var candidant_choisi = document.getElementById('candidant_choisi');
      var cards = document.querySelectorAll('.card');
      var btnImgCans = document.querySelectorAll('.btnImgCan');

      function selectCandidate(index) {
        radios.forEach(r => r.checked = false);
        btnVotes.forEach(bv => {
          bv.querySelector('i').classList.remove('voteGreen', 'animate__pulse', 'animate__animated');
        });
        cards.forEach(card => card.classList.remove('selected-card'));

        radios[index].checked = true;
        candidant_choisi.textContent = candidateNames[index].textContent;

        var btnVote = btnVotes[index];
        btnVote.querySelector('i').classList.add('voteGreen', 'animate__animated', 'animate__pulse');
        cards[index].classList.add('selected-card');
      }

      btnVotes.forEach(function(btnVote, index) {
        btnVote.addEventListener('click', function(e) {
          e.preventDefault();
          selectCandidate(index);
        });
      });

      btnImgCans.forEach(function(imgCan, index) {
        imgCan.addEventListener('click', function(e) {
          e.preventDefault();
          selectCandidate(index);
        });
      });

      // Ouverture de la modal au clic sur le bouton flottant
      document.getElementById('floatingValidateBtn').addEventListener('click', function() {
        var selected = false;
        radios.forEach(radio => { if(radio.checked) selected = true; });
        if(!selected) {
          toastr.error("Veuillez sélectionner un candidat avant de valider.");
          return;
        }
        document.getElementById('confirmationModal').classList.remove('hidden');
      });

      // Fermeture de la modal
      document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('confirmationModal').classList.add('hidden');
      });
    });
  </script>
</body>
</html>