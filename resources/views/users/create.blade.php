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
    <label for="entreprise_id" class="form-label">Entreprise</label>
    <!-- Champ caché avec l'ID de l'entreprise -->
    <input type="hidden" name="entreprise_id" value="{{ $entreprises->firstWhere('nom_entreprise', 'Elyos Digital Tunisie')->id }}">
    <p class="form-control">Elyos Digital Tunisie</p>  <!-- Affiche l'entreprise en texte mais non modifiable -->
</div>



                <div class="mb-3">
                    <label for="account_status" class="form-label">Statut du compte</label>
                    <select class="form-control" id="account_status" name="account_status" required>
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                        <option value="suspended">Suspendu</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Ajouter</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
