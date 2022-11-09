@extends('admins.dashboard')
@section("content")

    <title>Inscription</title>

</head>
<body>

    {{-- <img class="rounded mx-auto d-block" src="/picturesform/sup.png" alt="logo"> --}}

    {{-- <div id="container" class="mt-5"> --}}
        <!-- zone de connexion -->

        {{-- <form action="/posts/trait" method="post">
            <div class="results">
                @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                @if(Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
                @endif
            </div>

            @csrf
            <div class="mt-0 ">
                <h1 >Inscription</h1>

                  <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" name="matricule" placeholder="matricule">
                   </div>
                    <div class="col">
                      <input type="password" class="form-control" name="password" placeholder="password" >
                    </div>
                  </div><br>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4 text-cen">
                     <button type="submit" class="btn btn-primary" id='submit'>S'incrire</button>
                </div>

            </div>

        </form> --}}
        <header>
            <style>
              /* #intro {
                background-image: url(/picturesform/profil.jpg);
                height: 100vh;
              } */

              /* Height for devices larger than 576px */
              @media (min-width: 992px) {
                #intro {
                  margin-top: -58.59px;
                }
              }

              .navbar .nav-link {
                color: #fff !important;
              }
            </style>

       

            <!-- Background image -->

                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-xl-5 col-md-8">
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
                      <form action="/posts/trait" method="post" class="bg-white rounded shadow-5-strong p-5">
                        <!-- Email input -->
                        @csrf
                        <div class="form-outline mb-4">
                          <label class="form-label" for="form1Example1">Matricule</label>
                          <input type="text" id="form1Example1" class="form-control" name="matricule"/>
                        </div>


                        <!-- Password input -->
                        <div class="form-outline mb-4">
                          <label class="form-label" for="form1Example2">Password</label>
                          <input type="text" id="form1Example2" class="form-control" name="password" />
                        </div>

                        <!-- 2 column grid layout for inline styling -->
                        {{-- <div class="row mb-4">
                          <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                              <label class="form-check-label" for="form1Example3">
                                Remember me
                              </label>
                            </div>
                          </div>

                          <div class="col text-center">
                            <!-- Simple link -->
                            <a href="#!">Forgot password?</a>
                          </div>
                        </div> --}}

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary ">Sign in</button>
                      </form>
                    </div>
                  </div>
                </div>

            <!-- Background image -->
          </header>
          <!--Main Navigation-->

          <!--Footer-->

@endsection
