@extends('admins.dashboard')

@section('content')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>


{{-- form to create a new candidat --}}

<form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="page-header">
            <h3 class="page-title">
                Ajouter un Candidat
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">  Ajouter un Candidat</li>
                </ol>
            </nav>
          </div>
          <div class="row">
             
                    <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Ajouter un candidat</h4>
                        <p class="card-description">
                        Remplissez le formulaire
                       
                        </p>
                        
                            <div class="form-group">
                            <label for="exampleInputUsername1">Nom & Prénom(s) du candidat</label>
                            <input type="text" name="nom" class="form-control" id="exampleInputUsername1" placeholder="Nom et prénom(s) du candidat">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Slogan du candidat</label>
                            <input type="text" name="slogan"  class="form-control" id="exampleInputEmail1" placeholder="Slogan du candidat">
                            </div>
                            
                        
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Image du candidat</h4>
                        <p class="card-description">
                        Insérer l'image du candidat
                        </p>
                        <div class="card">
                        
                        <input type="file" name="profil"  />
                        
                    </div>
                        </div>
                    </div>
                    </div>
                    <div class="text-center">
                     <button type="submit" class="btn btn-primary mr-2">Envoyer</button>
                    </div>
             
          
          </div>
          </form>
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
 </script>   
@endsection