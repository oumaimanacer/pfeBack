@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Modifier une Entreprise</h2>
    
    <form action="{{ route('entreprise.update', $entreprises->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_entreprise" class="form-label">Nom de l'Entreprise</label>
            <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" value="{{ $entreprises->nom_entreprise }}" required>
        </div>

        <div class="mb-3">
    <label for="secteur_activite" class="form-label">Secteur d'Activité</label>
    <input type="text" class="form-control" id="secteur_activite" name="secteur_activite" value="{{ $entreprises->secteur_activite }}" required>
</div>
<div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $entreprises->email }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password"  required>
    </div>


        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $entreprises->adresse }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_de_telephone" class="form-label">Numéro de Téléphone</label>
            <input type="text" class="form-control" id="numero_de_telephone" name="numero_de_telephone" value="{{ $entreprises->numero_de_telephone }}" required>
        </div>

        <div class="mb-3">
            <label for="nombre_employes" class="form-label">Nombre d'Employés</label>
            <input type="number" class="form-control" id="nombre_employes" name="nombre_employes" value="{{ $entreprises->nombre_employes }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
