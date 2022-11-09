<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link href="{{ url('picturesform/sup.jpg') }}" rel="icon">
    <link href="{{ url('picturesform/sup.jpg') }}" rel="apple-touch-icon">


    <title>SUP | E-vote</title>
</head>
<body>
    <div class="card text-bg-dark">
        <img src="/picturesform/profil.jpg" class="card-img opacity-25" alt="...">
        <div class="card-img-overlay">
          <h5 class="card-title text-center mt-2 fw-bold display-3 text-warning ">BIENVENUE <br>ELECTION AU POSTE DE LEADER MANAGER 2022-2023</h5>
          <div class="results">
            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif
            <div class="results">
                @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                 @endif
           </div>
        </div>
      </div>
    </div>
    <form method="post" action="/posts/check">
        @csrf
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Matricule</h1>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <div class="results">
                            @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="matricule" placeholder="Saisissez votre Matricule">
                            @if ($errors->has('matricule'))
                            <span ><strong>{{ $errors->first('matricule') }}</strong></span>
                          @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                    <a class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Suivant</a>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Mot de passe</h1>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Saisissez le mot de passe" >
                            @if ($errors->has('password'))
                            <span ><strong>{{ $errors->first('password') }}</strong></span>
                          @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                    <a class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Retour</a>
                    <button class="btn btn-success" type="submit">Login</button>

                    </div>
                </div>
                </div>
            </div>
    </form>
<div class="text-center mt-4">
      <a class="btn btn-danger" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Cliquez-ici pour voter</a>
</div>


    </body>
</html>
