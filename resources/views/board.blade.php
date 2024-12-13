<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Connexion - Sup'Vote</title>
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
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl overflow-hidden animate__animated animate__fadeInUp flex flex-col">
    <!-- Illustration -->
    <div class="relative w-full h-44 flex items-center justify-center bg-cover bg-center" 
     style="background-image: url('/new-template/images/login-vote-mobile.png');">
  <div class="absolute inset-0 bg-black bg-opacity-30"></div>
  <img src="/new-template/images/sup.jpeg" 
       alt="Illustration" 
       class="relative h-32 w-32 object-cover rounded-full border-4 border-white shadow-lg animate__animated animate__fadeInDown"/>
</div>

    <div class="p-6 flex flex-col items-center">
      <!-- Logo & Titre -->
      <h1 class="text-2xl font-bold text-blue-700 tracking-tight mb-1 animate__animated animate__fadeInDown">Sup-<span class="text-orange-500">Vote</span></h1>
      <p class="text-gray-600 text-sm text-center mb-4 animate__animated animate__fadeInDown">Élection du Leader Manager</p>

      <!-- Timer -->
      <div class="bg-blue-50 p-4 rounded-xl w-full text-center mb-6 animate__animated animate__fadeIn timer-container">
        <div class="flex items-center justify-center gap-2 mb-3 text-blue-700 font-semibold text-sm">
          <span>⏳</span>
          <span>Temps restant pour voter</span>
        </div>
        <div class="flex justify-center gap-4 text-blue-700">
          <div class="text-center">
            <span class="text-lg font-bold" id="days">00</span>
            <div class="text-gray-500 text-xs">Jours</div>
          </div>
          <div class="text-center">
            <span class="text-lg font-bold" id="hours">00</span>
            <div class="text-gray-500 text-xs">Heures</div>
          </div>
          <div class="text-center">
            <span class="text-lg font-bold" id="minutes">00</span>
            <div class="text-gray-500 text-xs">Minutes</div>
          </div>
          <div class="text-center">
            <span class="text-lg font-bold" id="seconds">00</span>
            <div class="text-gray-500 text-xs">Secondes</div>
          </div>
        </div>
      </div>

      <!-- Formulaire -->
      <form method="post" action="/posts/check" class="w-full space-y-5 animate__animated animate__fadeInRight">
        @csrf
        <div>
          <label for="matricule" class="block mb-1 text-gray-700 font-semibold text-sm">Matricule</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><i class="fa fa-user"></i></span>
            <input type="text" name="matricule" id="matricule" placeholder="Entrez votre matricule" required
              class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" />
          </div>
        </div>

        <div>
          <label for="password" class="block mb-1 text-gray-700 font-semibold text-sm">Mot de passe</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required
              class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" />
          </div>
        </div>

        <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-orange-500 transition transform hover:scale-105 text-sm animate__animated animate__bounceIn">
          Se connecter
        </button>
      </form>

      <!-- Footer -->
      <footer class="mt-6 text-gray-400 text-xs text-center animate__animated animate__fadeIn">
        © 2024 <a href="https://supmanagement.ml" class="text-blue-600 hover:underline">Sup'Management</a>. Tous droits réservés.
      </footer>
    </div>
  </div>

  <!-- Toastr & Timer Scripts -->
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
    });

    function updateTimer() {
      const currentTime = new Date();
      const endDate = new Date(currentTime.getFullYear(), 11, 17, 23, 59, 59);
      const timeDifference = endDate - currentTime;

      if (timeDifference <= 0) {
        document.querySelector('.timer-container').innerHTML =
          '<h5 class="text-red-600">Le temps de vote est écoulé.</h5>';
        return;
      }

      const seconds = Math.floor(timeDifference / 1000);
      const days = Math.floor(seconds / (24 * 60 * 60));
      const hours = Math.floor((seconds % (24 * 60 * 60)) / 3600);
      const minutes = Math.floor((seconds % 3600) / 60);
      const remainingSeconds = seconds % 60;

      document.getElementById('days').textContent = String(days).padStart(2, '0');
      document.getElementById('hours').textContent = String(hours).padStart(2, '0');
      document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
      document.getElementById('seconds').textContent = String(remainingSeconds).padStart(2, '0');
    }

    setInterval(updateTimer, 1000);
    document.addEventListener('DOMContentLoaded', updateTimer);
  </script>
</body>
</html>