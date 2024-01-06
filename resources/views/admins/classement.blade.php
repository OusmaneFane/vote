@extends('admins.dashboard2')

@section("content")
 <script src="https://cdn.jsdelivr.net/npm/confetti-js"></script>
 <style>
    body {
        margin: 0;
    }

    #confetti-canvas {
        position: absolute;
        width: 100%;
        height: 100%;
        margin-top: -10px; /* Ajustez cette valeur selon vos besoins */
    }

    /* ... (votre code CSS existant) ... */
</style>

<canvas id="confetti-canvas"></canvas>

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Classement de l'ELECTION LEADER MANAGER 2023-2024</h4>
            <p class="card-description"></p>
            <div class="row">
                @foreach ($candidats as $candidat )  
                <div class="col-md-4 h-100">
                    <div class="bg-{{ $candidat->color}} p-4 @if($candidat->titre === 'Président LEADER MANAGER') president-animation @endif fireworks-container">
                        <h6 class="card-title">{{ $candidat->titre}}</h6>
                        <div id="profile-list-left" class="py-2">
                            <div class="card rounded mb-2">
                                <div class="card-body p-3">
                                    <div class="media">
                                        <img class="rounded-circle"  src="/storage/candidats/{{$candidat->photo}}" alt="">
                                        <div class="media-body text-center">
                                            <h6 class="mb-1">{{ $candidat->nom}}</h6>
                                            <p class="mb-0 text-muted">
                                                <b>{{ $candidat->totalVotes}} (voix)</b>                         
                                            </p>
                                        </div>                              
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    // Trigger confetti animation
    confetti.create(document.getElementById('confetti-canvas'), {
        resize: true,
        useWorker: true
    });
</script>
@endsection