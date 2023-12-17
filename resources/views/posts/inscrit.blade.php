@extends('admins.dashboard')
@section("content")




          <div class="page-header">
            <h3 class="page-title">
                Ajouter un Etudiant
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouter un étudiant</li>
                </ol>
            </nav>
          </div>
          <div class="row">
            
           
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter un étudiant</h4>
                  <p class="card-description">
                    Remplissez le formulaire
                    <div class="results">
                                @if(Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                 @endif
                    </div>
                    <div class="results">
                                @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                                 @endif
                    </div>
                  </p>
                  <form class="forms-sample" action="/posts/trait" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputName1">Matricule</label>
                      <input type="text" name="matricule" class="form-control" id="exampleInputName1" placeholder="Matricule">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                    <label for="classe">Classe</label>
                    <select class="form-control" name="classe_id">
                      <option value="" selected>Choisir la classe</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                        @endforeach
                   </select>
                   </div>
                    <button type="submit" class="btn btn-primary mr-2">Envoyer</button>
                    <button class="btn btn-light">Annuler</button>
                  </form>
                </div>
              </div>
            </div>
        
          </div>

@endsection
