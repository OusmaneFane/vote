
<!DOCTYPE html>
<html>
<head>
   <title>SUP | E-vote</title>
   <meta charset="utf-8">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
   <link rel="stylesheet" type="text/css" href="{{ url('designsform/defaut.css') }}">
</head>
<body>
   <header>
   </header>
   {{-- <h1>Bienvenue {{ $actel_user->matricule }}</h1> --}}
   <div class="text-center">
   <button type="button" class="btn btn-warning text-black">Bienvenue {{ $actel_user->matricule }}</button>
   </div>
   @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>

            @endif

<form method="post" action="/posts/validate">
   @csrf
  @foreach ($candidats as  $candidat)


            <div class="junior">
                <input type="radio" name="candidat_id" value=" {{ $candidat['id'] }} ">
                <label  for="JUNIOR"> <b>{{ $candidat['nom']  }}</b></label><br>
                <img class="" src="/{{ $candidat['photo']  }}" alt="" /><br>
            </div>

   @endforeach
      <p>
       <button type="submit" class=" d-block btn btn-danger">Valider votre vote</button>
   </p>
</form>
</section>
       <script src="pops.js"></script>
</body>
</html>
