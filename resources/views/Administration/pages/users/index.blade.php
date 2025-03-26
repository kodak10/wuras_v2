@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">

   

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                   
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">Tous les utilisateurs</h4>
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                            Ajouter un Utilisateur
                        </a>
                   </div>
                </div>

                <div>
                    <div class="table-responsive">
                        <table id="userTable" class="table align-middle mb-0 table-hover table-centered">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal_{{ $user->id }}">
                                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                    
                                    <!-- Modal pour modifier l'utilisateur -->
                                    <div class="modal fade" id="editUserModal_{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserModalLabel_{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel_{{ $user->id }}">Modifier les informations de {{ $user->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                    
                                                        <div class="mb-3">
                                                            <label for="name_{{ $user->id }}" class="form-label">Nom</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name_{{ $user->id }}" name="name" value="{{ old('name', $user->name) }}" required>
                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                    
                                                        <div class="mb-3">
                                                            <label for="email_{{ $user->id }}" class="form-label">Email</label>
                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email_{{ $user->id }}" name="email" value="{{ old('email', $user->email) }}" required>
                                                            @error('email')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                    
                                                        <div class="mb-3">
                                                            <label for="roles_{{ $user->id }}" class="form-label">Rôle</label>
                                                            <select class="form-control @error('roles') is-invalid @enderror" id="roles_{{ $user->id }}" name="roles[]" multiple required>
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role->id }}" {{ $user->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('roles')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                    
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialisation de DataTable sur la table avec id userTable
        $('#userTable').DataTable({
            "paging": true,            // Active la pagination
            "searching": true,         // Active la recherche
            "ordering": true,          // Active le tri des colonnes
            "lengthChange": false,     // Désactive la possibilité de changer le nombre de lignes par page
            "info": true,              // Affiche l'information sur les résultats (ex: "Affichage de 1 à 10 de 50 entrées")
            "language": {
                "search": "Rechercher:",      // Texte pour la barre de recherche
                "lengthMenu": "Afficher _MENU_ entrées",  // Texte pour le menu de sélection des entrées par page
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",  // Info de pagination
                "infoEmpty": "Affichage de 0 à 0 sur 0 entrées", // Texte quand il n'y a pas de résultats
                "zeroRecords": "Aucun résultat trouvé", // Texte quand il n'y a pas de résultats correspondant
                "paginate": {
                    "previous": "Précédent",  // Texte pour le bouton précédent
                    "next": "Suivant"         // Texte pour le bouton suivant
                }
            }
        });
    });
</script>

@endpush
