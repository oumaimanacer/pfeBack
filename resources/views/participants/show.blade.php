@extends('layouts.admin') 

@section('content')
<div class="container">
    <h2>Détails du participant</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom complet</th>
                <th>Status du compte</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->nom }} {{ $user->prenom }}</td>
                <td>{{ $user->account_status }} </td>
                
            </tr>
        </tbody>
    </table>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection
