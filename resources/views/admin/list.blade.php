@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-danger mb-3">List of Users</h2>

    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Bouton Ajouter -->
            <a href="{{ route('entreprise.create') }}" class="btn btn-danger">
                <i class="fa fa-plus"></i> Add Entreprise
            </a>

            <!-- Barre de Recherche -->
            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-danger">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>

        <table class="table table-hover table-bordered text-center">
            <thead class="table-light">
                <tr class="text-danger">
                    <th>Nom Entreprise</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Secteur d'Activité</th>
                    <th>Adresse</th>
                    <th>Numéro Téléphone</th>
                    <th>Nombre Employés</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entreprises as $entreprise)
                <tr>
                    <td>{{ $entreprise->nom_entreprise }}</td>
                    <td>{{ $entreprise->email }}</td>
                    <td>••••••••</td> 
                    <td>{{ $entreprise->secteur_activite }}</td>
                    <td>{{ $entreprise->adresse }}</td>
                    <td>{{ $entreprise->numero_de_telephone }}</td>
                    <td>{{ $entreprise->nombre_employes }}</td>
                    <td>
                      
                        <a href="{{ route('entreprise.edit', $entreprise->id) }}" class="text-warning mx-2">
                            <i class="fa fa-pencil"></i>
                        </a>

                       
                        <form action="{{ route('entreprise.destroy', $entreprise->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
