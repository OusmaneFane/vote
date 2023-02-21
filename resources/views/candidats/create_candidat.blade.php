@extends('admins.dashboard')

@section('content')

<h3>Ajouter un nouveau candidat</h3>
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

{{-- form to create a new candidat --}}

<form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom du candidat">
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="text" class="form-control" id="photo" name="photo" placeholder="Entrer le nom de la photo du candidat">
    </div>
    <div class="form-group">
        <label for="parti">Slogan</label>
        <input type="text" class="form-control" id="slogan" name="slogan" placeholder="Entrer le slogan du candidat">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>


@endsection