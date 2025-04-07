@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-danger">🏢 Liste des Entreprises</h2>
        <a href="{{ route('entreprise.create') }}" class="btn btn-primary">➕ Ajouter une Entreprise</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <!-- Barre de recherche -->
            <div class="input-group mb-3" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="🔍 Rechercher...">
                <button class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>

            <table class="table table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nom Entreprise</th>
                        <th>Email</th>
                        <th>Secteur d'Activité</th>
                        <th>Adresse</th>
                        <th>Numéro Téléphone</th>
                        <th>Nombre Employés</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($entreprises as $entreprise)
                    <tr>
                        <td>{{ $entreprise->nom_entreprise }}</td>
                        <td>{{ $entreprise->email }}</td>
                        <td>{{ $entreprise->secteur_activite }}</td>
                        <td>{{ $entreprise->adresse }}</td>
                        <td>{{ $entreprise->numero_de_telephone }}</td>
                        <td><span class="badge bg-info">{{ $entreprise->nombre_employes }}</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('entreprise.edit', $entreprise->id) }}" class="btn btn-sm btn-warning">✏ Modifier</a>
                                <form action="{{ route('entreprise.destroy', $entreprise->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑 Supprimer</button>
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
@endsection
