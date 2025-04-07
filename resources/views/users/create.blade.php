@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-danger">Ajouter un Employé</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">Sélectionner un rôle</option>
                        <option value="SuperAdmin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="Employe">Employé</option>
                        <option value="Responsable RH">Responsable RH</option>
                        <option value="Formateur_interne">Formateur interne</option>
                        <option value="Formateur_externe">Formateur externe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="poste" class="form-label">Poste</label>
                    <input type="text" class="form-control" id="poste" name="poste">
                </div>

                <div class="mb-3">
                    <label for="dateEmbauche" class="form-label">Date d'embauche</label>
                    <input type="date" class="form-control" id="dateEmbauche" name="dateEmbauche">
                </div>

                <div class="mb-3">
                    <label for="entreprise" class="form-label">Entreprise</label>
                    <input type="text" class="form-control" id="entreprise" name="entreprise">
                </div>

                <button type="submit" class="btn btn-success">Ajouter</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
