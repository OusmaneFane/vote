@extends('admins.dashboard2')

@section("content")






<div class="page-header">
            <h3 class="page-title">
              Dépouillement
              <div class="results">
                            @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                            @endif
                        </div>
                            <div class="results">
                                @if(Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                        </div>
            </h3>
          </div>
          <div class="row grid-margin">
            <div class="col-12">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    @foreach($candidats as $candidat )
                      <div class="statistics-item">
                        <p>
                        <img class="rounded-circle" height="50" width="50" src="/storage/candidats/{{$candidat->photo}}" alt="">

                         {{$candidat->nom}}
                        </p>
                        <h2>{{ $candidat->totalVotes }}</h2>
                        <label class="badge badge-outline-primary badge-pill"><b>{{ number_format($candidat->percentageVotes, 2) }}% de voix</b></label>
                      </div>
                    @endforeach
                     
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            @foreach ($candidats as  $candidat)

             <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body d-flex flex-column ">
                        <h4 class="card-title">
                            <i class="fa fa-user"></i>
                            {{ $candidat->nom }}
                        </h4>
                        <div class="flex-grow-1 d-flex flex-column justify-content-between align-items-center">
                            <img class="rounded-circle mb-3" height="150" width="150" src="/storage/candidats/{{ $candidat->photo }}" alt="">

                            <!-- Boutons + et - -->
                            <div>
                                <a href="?filtre={{ $candidat['nom'] }}" data-candidat-id="{{ $candidat->id }}" class="btn btn-primary btn-vote ">+</a>
                                <a href="?delete={{ $candidat['id'] }}" data-candidat-id="{{ $candidat->id }}" class="btn btn-danger btn-remove-vote">-</a>
                            </div>
                        </div>
                    </div>
                </div>
             </div>

            @endforeach
            
          </div>

          <!-- Assurez-vous d'inclure jQuery avant ce script si vous utilisez jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Gestion du vote
        $('.btn-vote').on('click', function () {
            var candidatId = $(this).data('candidat-id');
            castVote(candidatId);
        });

        // Gestion du retrait de vote
        $('.btn-remove-vote').on('click', function () {
            var candidatId = $(this).data('candidat-id');
            removeVote(candidatId);
        });

        // Fonction pour envoyer la requête Ajax pour le vote
        function castVote(candidatId) {
            $.ajax({
                type: 'POST',
                url: '/admins/vote',  // Mettez à jour l'URL en fonction de votre route
                data: {
                    candidat_id: candidatId,
                    _token: '{{ csrf_token() }}',  // Assurez-vous de passer le jeton CSRF
                },
                success: function (response) {
                    // Mettez à jour la vue avec la nouvelle information
                    updateView(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        // Fonction pour envoyer la requête Ajax pour le retrait de vote
        function removeVote(candidatId) {
            $.ajax({
                type: 'POST',
                url: '/admins/remove-vote',  // Mettez à jour l'URL en fonction de votre route
                data: {
                    candidat_id: candidatId,
                    _token: '{{ csrf_token() }}',  // Assurez-vous de passer le jeton CSRF
                },
                success: function (response) {
                    // Mettez à jour la vue avec la nouvelle information
                    updateView(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        // Fonction pour mettre à jour la vue
        function updateView(response) {
            // Mettez à jour la vue avec les données reçues
            // Vous pouvez utiliser jQuery pour manipuler le DOM et mettre à jour les éléments nécessaires
            // Exemple : $('#total-votes').text(response.totalVotes);
            // Exemple : $('#percentage-candidat-1').text(response.candidat1Percentage);
        }
    });
</script>


@endsection
