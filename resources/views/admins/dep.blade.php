@extends('admins.dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="{{ url('designsform/defaut.css') }}">

<style>
    .image-ronde{
      width : 150px; height : 150px;
      border: none;
      -moz-border-radius : 75px;
      -webkit-border-radius : 75px;
      border-radius : 75px;
    }
    </style>
@foreach ($candidats as  $candidat)
<div class="dep">
    <img class="image-ronde" src="/{{ $candidat['photo']  }}" alt="" >

       <a href="?filtre={{ $candidat['nom'] }}" class="btn btn-danger btn-lg  gap-2 col-4 mx-auto">Ajouter</a>
       <a href="?filtredec={{ $candidat['nom'] }}" class="btn btn-secondary btn-lg  gap-2 col-4 mx-auto">Rétirer</a>

</div>

@endforeach



@endsection
