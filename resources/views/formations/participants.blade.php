@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <!-- Onglets -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('formations.participants', $formation->id) }}">Participants list</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('formations.feedbacks', $formation->id) }}">Feedback list</a>
        </li>
    </ul>

    <!-- Tableau des participants -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Liste des participants à la formation : 
                <strong>{{ $formation->titre }}</strong>
            </h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <!--<th>ID</th>-->
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Poste</th>
                        <th>Date de participation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formation->users as $user)
                        <tr>
                            <!--<td>{{ $user->id }}</td>-->
                            <td>{{ $user->nom }} {{ $user->prenom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role ?? '-' }}</td>
                            <td>{{ $user->poste ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->pivot->date_participation)->format('d/m/Y') ?? '-' }}</td>
                            <td>
                                <!--<button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $user->id }}">
                                    Voir
                                </button>-->
                                <a href="{{ route('participants.show', $user->id) }}" class="btn btn-info">👁</a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="detailModal{{ $user->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $user->id }}">Détails du participant</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--<p><strong>ID :</strong> {{ $user->id }}</p>-->
                                        <p><strong>Nom :</strong> {{ $user->nom }}</p>
                                        <p><strong>Prénom :</strong> {{ $user->prenom }}</p>
                                        <p><strong>Email :</strong> {{ $user->email }}</p>
                                        <p><strong>Role :</strong> {{ $user->role ?? 'Non renseigné' }}</p>
                                        <p><strong>Poste :</strong> {{ $user->poste ?? 'Non renseignée' }}</p>
                                        <p><strong>Date de participation :</strong> {{ \Carbon\Carbon::parse($user->pivot->date_participation)->format('d/m/Y') ?? '-' }}</p>
                                        <p><strong>Status du compte :</strong> {{ $user->account_status ?? 'Non défini' }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
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
@endsection
