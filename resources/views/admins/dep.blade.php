@extends('admins.dashboard2')

@section("content")
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<div class="page-header">
    <h3 class="page-title">Dépouillement</h3>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    @foreach($candidats as $candidat)
                        <div class="statistics-item">
                            <p>
                                <img class="rounded-circle" height="50" width="50" src="/storage/candidats/{{$candidat->photo}}" alt="">
                                {{$candidat->nom}}
                            </p>
                            <h2 id="total-votes-{{ $candidat->id }}">{{ $candidat->totalVotes }}</h2>
                            <label class="badge badge-outline-primary badge-pill">
                                <span id="pourcentage-{{ $candidat->id }}">
                                    <b>{{ number_format($candidat->percentageVotes, 2) }}% de voix</b>
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach ($candidats as $candidat)
        <div class="col-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">
                        <i class="fa fa-user"></i>
                        {{ $candidat->nom }}
                    </h4>
                    <div class="flex-grow-1 d-flex flex-column justify-content-between align-items-center">
                        <img class="rounded-circle mb-3" height="150" width="150" src="/storage/candidats/{{ $candidat->photo }}" alt="">
                        <!-- Boutons + et - -->
                        <div>
                            <a href="javascript:void(0)" data-candidat-id="{{ $candidat->id }}" class="btn btn-primary btn-vote">+</a>
                            <a href="javascript:void(0)" data-candidat-id="{{ $candidat->id }}" class="btn btn-danger btn-remove-vote">-</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Assurez-vous d'inclure jQuery avant ce script si vous utilisez jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   <script>
    $(function () {
        let oldTotalVotes = null;

        setInterval(() => {
            $.ajax({
                type: 'GET',
                url: '/admins/dep-data',
                success: function (response) {
                    if (oldTotalVotes === response.totalVotes) return;
                    else oldTotalVotes = response.totalVotes;

                    response.candidats.forEach(function (candidat) {
                        // Utilisez directement les variables globales candidates et votes
                        let pourcentageElement = document.getElementById('pourcentage-' + candidat.id);
                         pourcentageElement.innerHTML = candidat.percentageVotes.toFixed(2) + '% de voix';
                    });
                },
                error: function (error) {
                    console.log('Erreur AJAX', error);
                }
            });
        }, 2000);
    });
</script>


<script>
    $(document).ready(function () {
        // Gestion du vote
        $('.btn-vote').on('click', function () {
            var candidatId = $(this).data('candidat-id');
            animateVote(candidatId);
            castVote(candidatId);
        });

        // Gestion du retrait de vote
        $('.btn-remove-vote').on('click', function () {
            var candidatId = $(this).data('candidat-id');
            animateRemoveVote(candidatId);
            removeVote(candidatId);
        });

         // Fonction pour animer la croissance lors du vote
    function animateVote(candidatId) {
        var targetElement = $('#total-votes-' + candidatId);
        var targetElementTwo = $('#pourcentage-' + candidatId);
        targetElement.animate({ fontSize: '+=50px' }, 'fast', function () {
            // Animation terminée
            targetElement.animate({ fontSize: '-=50px' }, 'fast');
        });
        targetElementTwo.animate({ fontSize: '+=10px' }, 'fast', function () {
            // Animation terminée
            targetElementTwo.animate({ fontSize: '-=10px' }, 'fast');
        });
    }

    // Fonction pour animer la réduction lors du retrait de vote
    function animateRemoveVote(candidatId) {
        var targetElement = $('#total-votes-' + candidatId);
         var targetElementTwo = $('#pourcentage-' + candidatId);
        targetElement.animate({ fontSize: '-=20px' }, 'fast', function () {
            // Animation terminée
            targetElement.animate({ fontSize: '+=20px' }, 'fast');
        });
        targetElementTwo.animate({ fontSize: '-=20px' }, 'fast', function () {
            // Animation terminée
            targetElementTwo.animate({ fontSize: '+=12px' }, 'fast');
        });
    }

// Fonction pour envoyer la requête Ajax pour le vote
function castVote(candidatId) {
    // Récupérez le nombre actuel de votes du candidat
    var currentVotes = parseInt($('#total-votes-' + candidatId).text());

    $.ajax({
        type: 'POST',
        url: '/admins/vote',
        data: {
            candidat_id: candidatId,
            current_votes: currentVotes,  // Envoyez le nombre actuel de votes
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
            if (response.success) {
                // Mettez à jour la vue avec le nouveau total
                updateView(response, candidatId);
            } else {
                console.log(response.message);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}


// Fonction pour envoyer la requête Ajax pour le retrait de vote
function removeVote(candidatId) {
    // Récupérez le nombre actuel de votes du candidat
    var currentVotes = parseInt($('#total-votes-' + candidatId).text());

    $.ajax({
        type: 'POST',
        url: '/admins/remove-vote',
        data: {
            candidat_id: candidatId,
            current_votes: currentVotes,  // Envoyez le nombre actuel de votes
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
            if (response.success) {
                // Mettez à jour la vue avec le nouveau total
                updateView(response, candidatId);
            } else {
                console.log(response.message);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}


        // Fonction pour mettre à jour la vue
        function updateView(response, candidatId) {
            // Mettez à jour la vue avec les données reçues
            // Vous pouvez utiliser jQuery pour manipuler le DOM et mettre à jour les éléments nécessaires
            $('#total-votes-' + candidatId).text(response.totalVotes);
            
        }
    });
</script>

@endsection
