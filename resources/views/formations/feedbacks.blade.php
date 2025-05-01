@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <!-- Onglets -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('formations.participants', $formation->id) }}">Participants list</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('formations.feedbacks', $formation->id) }}">Feedback list</a>
        </li>
    </ul>

    <!-- Liste des feedbacks -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Feedbacks de la formation : 
                <strong>{{ $formation->titre }}</strong>
            </h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Participant</th>
                        <th>contenu</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($formation->feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->user->nom }} {{ $feedback->user->prenom }}</td>
                            <td>{{ $feedback->contenu }}</td>
                            <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Aucun feedback disponible.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
