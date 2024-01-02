@extends('admins.dashboard2')

@section("content")
<style>
    .president-animation {
        animation: shake 0.5s ease-in-out infinite;
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(10px);
        }
    }
</style>

 <div class="page-header">
            <h3 class="page-title">
              Classement
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Classement</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            @foreach ($candidats as $candidat )  
            <div class="col-md-4 grid-margin stretch-card ">
              <div class="card bg-{{ $candidat->color}} @if($candidat->titre === 'Président LEADER MANAGER') president-animation @endif">
                <div class="card-body">
                  <h2 class="card-title text-white">{{ $candidat->titre}}</h2>
                  <p class="card-description text-center"><code><b>{{ $candidat->nom}}</b></code></p>
                  <div class="template-demo text-center ">
                    <img class="rounded-circle"  src="/storage/candidats/{{$candidat->photo}}" alt="">
                  </div>
                </div>
              </div>
            </div>
            @endforeach   
          </div>
  <!-- Inclure le script particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <script>
        // Initialiser particles.js pour le candidat président
        particlesJS('president-particles', {
            particles: {
                number: {
                    value: 80,
                },
                shape: {
                    type: 'circle',
                },
                size: {
                    value: 5,
                },
                move: {
                    speed: 3,
                },
            },
        });
    </script>
@endsection