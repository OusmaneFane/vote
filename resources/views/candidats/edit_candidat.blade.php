@extends('admins.dashboard')

@section('content')
    <h3><i class="fa fa-angle-right"></i> Liste des candidats</h3>
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
    <div class="row mb">
        <!-- page start-->
        <div class="content-panel">
            <div class="adv-table">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
                    id="hidden-table-info">
                    {{-- foreach candidats in table --}}
                    <thead>
                        <tr>
                            <th class="hidden-phone">Id</th>
                            <th class="hidden-phone">Nom</th>
                            <th class="hidden-phone">Photos</th>
                            <th class="hidden-phone">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidats as $candidat)
                            <tr class="gradeX">
                                 <!-- Modal pour éditer -->
                        <div class="modal fade" id="edit-modal-{{ $candidat->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="edit-modal-{{ $candidat->id }}-label">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-modal-{{ $candidat->id }}-label">Modifier Candidat
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
                                            <p>Etes-vous sûr de vouloir supprimer ce candidat?</p>
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

                                <td class="hidden-phone">{{ $candidat->id }}</td>
                                <td class="hidden-phone">{{ $candidat->nom }}</td>
                                <td class="hidden-phone">{{ $candidat->photo }}</td>
                                <td class="hidden-phone">
                                    <div class="d-flex">
                                        <button class="btn btn-success btn-xs align-middle mr-3"><i
                                                class="fa fa-check"></i></button>
                                        <style>
                                            .btn-xs {
                                                text-align: center;
                                                margin-right: 7px;
                                            }
                                        </style>
                                        <button type="button" class="btn btn-primary btn-xs align-middle mr-1"
                                            data-toggle="modal" data-target="#edit-modal-{{ $candidat->id }}"><i
                                                class="fa fa-pencil"></i></button>
                                        <form action="{{ route('candidats.destroy', $candidat->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-xs align-middle"
                                                data-toggle="modal" data-target="#deleteModal{{ $candidat->id }}"><i
                                                    class="fa fa-trash-o "></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
        <!-- page end-->
    </div>
    <!-- /row -->
@endsection
