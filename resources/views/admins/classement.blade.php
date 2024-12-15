@extends('admins.dashboard2')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/confetti-js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

<style>
    #confetti-canvas {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 10;
    }

    .president-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
</style>

<canvas id="confetti-canvas"></canvas>

<div class="relative z-20 w-full max-w-7xl mx-auto px-4 py-6 bg-gray-50 min-h-screen">

    <!-- En-tête avec dégradé -->
    <div class="text-center mb-8">
        <div class="relative w-full h-32 bg-gradient-to-r from-blue-600 to-purple-600 flex items-center justify-center rounded-xl shadow-lg overflow-hidden">
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
            <h4 class="text-3xl font-bold text-white relative z-10"> ELECTION LEADER MANAGER 2024-2025</h4>
        </div>
        <p class="text-gray-700 mt-4">Félicitations à tous les candidats participants !</p>
    </div>

    <!-- Conteneur horizontal -->
    <div class="flex flex-row flex-nowrap justify-center gap-8 py-8 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        @foreach ($candidats as $candidat)
        @php
            $isPresident = ($candidat->titre === 'Président LEADER MANAGER');
        @endphp
        <div class="relative flex-shrink-0 w-64 bg-white rounded-lg shadow hover:shadow-xl transition transform hover:-translate-y-1 p-6 
                    @if($isPresident) president-animation border-2 border-green-400 @else border border-gray-200 @endif
                    bg-gradient-to-b from-white to-gray-50">

            <!-- Titre du candidat -->
            <h2 class="text-xl font-bold mb-3 text-center 
                       @if($isPresident) text-green-600 @else text-gray-800 @endif">
                {{ $candidat->titre }}
            </h2>
            
            <!-- Photo & Infos -->
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 rounded-full overflow-hidden mb-3 border-2 border-gray-200">
                    <img class="w-full h-full object-cover" src="/storage/candidats/{{ $candidat->photo }}" alt="Photo {{ $candidat->nom }}">
                </div>
                <h6 class="text-md font-semibold text-gray-700 mb-1 text-center">{{ $candidat->nom }}</h6>
                <p class="text-sm text-gray-500 text-center">
                    <strong>{{ $candidat->totalVotes }} voix</strong>
                </p>
            </div>

            <!-- Ruban #1 si Président -->
            @if($isPresident)
                <div class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">#1</div>
            @endif
        </div>
        @endforeach
    </div>

</div>

<script>
    // Déclenche l'animation de confettis
    confetti.create(document.getElementById('confetti-canvas'), {
        resize: true,
        useWorker: true
    })({ origin: { y: 0.7 } });
</script>
@endsection