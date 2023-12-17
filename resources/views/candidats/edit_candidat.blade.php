@extends('admins.dashboard')

@section('content')


    <div class="page-header">
            <h3 class="page-title">
              Liste des candidats
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
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liste des candidats</li>
              </ol>
            </nav>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">les candidats</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>id #</th>
                            <th>Noms & Prénom(s)</th>
                            <th>Photos</th>
                            <th>Action</th>
                           
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($candidats as $candidat)
                        <tr>
                        <div class="modal fade" id="edit-modal-{{ $candidat->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="edit-modal-{{ $candidat->id }}-label">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-modal-{{ $candidat->id }}-label">Modifier {{ $candidat->nom }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('candidats.update', $candidat->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nom">Nom</label>
                                                <input type="text" class="form-control" id="nom" name="nom"
                                                    value="{{ $candidat->nom }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="photo">Photo</label>
                                                <input type="text" class="form-control" id="photo" name="photo"
                                                    value="{{ $candidat->photo }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal pour supprimer -->
                        <div class="modal fade" id="deleteModal{{ $candidat->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModal{{ $candidat->id }}Label">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModal{{ $candidat->id }}Label">Supprimer Candidat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Etes-vous sûr de vouloir supprimer le candidat {{ $candidat->nom }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            <td>
                                <img class="rounded-circle" height="50" width="50" src="/storage/candidats/{{$candidat->photo}}" alt="">
                            </td>
                            <td>{{ $candidat->nom }}</td>
                            <td>{{ $candidat->photo }}</td>
                            <td>
                                <div class="d-flex">
                                       
                                        <style>
                                            .btn-xs {
                                                text-align: center;
                                                margin-right: 7px;
                                            }
                                        </style>
                                        <button type="button" class="btn btn-primary btn-xs align-middle mr-1"
                                            data-toggle="modal" data-target="#edit-modal-{{ $candidat->id }}"><i
                                                class="fa fa-edit"></i></button>
                                        <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-xs align-middle"
                                                data-toggle="modal" data-target="#deleteModal{{ $candidat->id }}"><i
                                                    class="fa fa-trash "></i></button>
                                        </form>
                                    </div>
                            </td>
                            
                        </tr>
                       @endforeach
                     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
