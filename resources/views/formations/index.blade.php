@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-danger">📚 Liste des Formations</h2>
        <a href="{{ route('formations.create') }}" class="btn btn-primary">➕ Ajouter une Formation</a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nombre de places</th>
                        <th>Type</th>
                        <th>Formateur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($formations as $formation)
                    <tr>
                        <td>{{ $formation->titre }}</td>
                        <td>{{ Str::limit($formation->description, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}</td>
                        <td><span class="badge bg-info">{{ $formation->nbr_place }}</span></td>
                        <td><span class="badge bg-success">{{ $formation->type }}</span></td>
                        <td><span class="badge bg-success">{{ $formation->formateur }}</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('formations.edit', ['id' => $formation->id]) }}" class="btn btn-sm btn-warning">✏ Modifier</a>
                                <form action="{{ route('formations.destroy', ['id' => $formation->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
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
