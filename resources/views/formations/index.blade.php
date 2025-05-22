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
                        <th>Heure</th> <!-- ✅ Ajouté ici -->
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
                        <td>{{ $formation->heure }}</td> <!-- ✅ Affichage de l'heure -->
                        <td><span class="badge bg-info">{{ $formation->nbr_place }}</span></td>
                        <td><span class="badge bg-success">{{ $formation->type }}</span></td>
                        <td><span class="badge bg-success">{{ $formation->formateur }}</span></td>
                        <td>
                            <div style="text-align: center;">
                                <a href="{{ route('formations.show', ['id' => $formation->id]) }}"
                                   class="btn btn-sm btn-info"
                                   title="Voir les détails"
                                   style="display: inline-block; margin-right: 5px;">
                                    👁
                                </a>

                                <a href="{{ route('formations.edit', ['id' => $formation->id]) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Modifier"
                                   style="display: inline-block; margin-right: 5px;">
                                    ✏
                                </a>

                                <form action="{{ route('formations.destroy', ['id' => $formation->id]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');"
                                      style="display: inline-block; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Supprimer">
                                        🗑
                                    </button>
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
